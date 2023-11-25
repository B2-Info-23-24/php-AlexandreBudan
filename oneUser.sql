SELECT
    JSON_OBJECT(
        'id', User.id,
        'email', User.email,
        'password', User.password,
        'firstName', User.firstName,
        'lastName', User.lastName,
        'phone', User.phone,
        'age', User.age,
        'gender', User.gender,
        'address', JSON_OBJECT(
            'id', Address.id,
            'address', Address.address,
            'city', Address.city,
            'code', Address.code,
            'country', Address.country,
            'status', Address.status
        ),
        'reservations', JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', Reservation.id,
                'car', JSON_OBJECT(
                    'id', Car.id,
                    'name', Car.name,
                    'type', Car.type,
                    'brand', JSON_OBJECT(
                        'id', Brand.id,
                        'name', Brand.name
                    ),
                    'color', JSON_OBJECT(
                        'id', Color.id,
                        'name', Color.name
                    )
                ),
                'price', Reservation.price,
                'beginning', Reservation.beginning,
                'ending', Reservation.ending,
                'finish', Reservation.finish
            )
        ),
        'favoris', JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', Favori.id,
                'car', JSON_OBJECT(
                    'id', Car.id,
                    'name', Car.name,
                    'type', Car.type,
                    'brand', JSON_OBJECT(
                        'id', Brand.id,
                        'name', Brand.name
                    ),
                    'color', JSON_OBJECT(
                        'id', Color.id,
                        'name', Color.name
                    ),
                    'price', Car.price,
                    'manual', Car.manual,
                    'minAge', Car.minAge,
                    'nbDoor', Car.nbDoor
                )
            )
        ),
        'creationDate', User.creationDate,
        'newsLetter', User.newsLetter,
        'verified', User.verified,
        'isAdmin', User.isAdmin,
        'status', User.status
    ) AS user
FROM
    User
LEFT JOIN
    Address ON User.addressId = Address.id
LEFT JOIN
    Reservation ON User.id = Reservation.userId
LEFT JOIN
    Car ON Reservation.carId = Car.id
LEFT JOIN
    Brand ON Car.brandId = Brand.id
LEFT JOIN
    Color ON Car.colorId = Color.id
LEFT JOIN
    Favori ON Favori.userId = User.id
WHERE
    User.id = 3
GROUP BY
    User.id;
