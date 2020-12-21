<?php

// SELECT reservation.reservation_id, reservation.users_id, reservation.status , reservation.play_time, playfields.image, playfields.name, playfields.price , reservation.notification FROM reservation INNER JOIN playfields on playfields.id = reservation.product_id INNER JOIN users on reservation.users_id = users.users_id where reservation.users_id = '1'