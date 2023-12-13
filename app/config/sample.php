<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$sql = <<<SQL
    INSERT INTO 
        `rec_center` (
            `center_name`
        )
    VALUES
        ( "Subang Jaya" ),
        ( "Bukit Bintang" ),
        ( "Shah Alam" ),
        ( "Cyber Jaya" ),
        ( "Kepong" );

    INSERT INTO 
        `user` (
            `dir_name`,
            `email`,
            `pwd`,
            `role`
        )
    VALUES
        (
            "sample_user",
            "jason_delulu@mail.com",
            "123",
            "artist"
        ),
        (
            "sample_user",
            "elizabeth_josh@mail.com",
            "123",
            "artist"
        );

    SET @last_user_id = LAST_INSERT_ID();

    INSERT INTO
        `user_lang` (
            `user_id`,
            `user_name`,
            `real_name`
        )
    VALUES
        (
            @last_user_id,
            "Jason",
            "Jason Delulu"
        ),
        (
            @last_user_id + 1,
            "Elizabeth",
            "Elizabeth Josh"
        );

    INSERT INTO
        `product` (
            `user_id`,
            `dir_name`,
            `price`,
            `quantity`
        )
    VALUES
        (
            @last_user_id,
            "carton_flower_pots",
            18,
            23
        ),
        (
            @last_user_id,
            "cloth_travel_bag",
            40,
            32
        ),
        (
            @last_user_id,
            "crocheted_flower_buds",
            27,
            34
        ),
        (
            @last_user_id,
            "flower_glass_vase",
            20,
            12
        ),
        (
            @last_user_id + 1,
            "handpainted_plates",
            18,
            22
        ),
        (
            @last_user_id + 1,
            "hanging_heart_chimes",
            22,
            44
        ),
        (
            @last_user_id + 1,
            "indoor_plastic_flowerpots",
            44,
            31
        ),
        (
            @last_user_id + 1,
            "reusable_coffee_mugs",
            50,
            14
        );

    SET @last_prod_id = LAST_INSERT_ID();

    INSERT INTO 
        `prod_lang` (
            `prod_id`,
            `prod_name`,
            `description`,
            `img_path`
        )
    VALUES
        (
            @last_prod_id,
            "Carton Flower Pots",
            "Introducing our eco-friendly carton flower pots, marrying sustainability with style for your green companions.",
            "carton_flower_pots.png"
        ),
        (
            @last_prod_id + 1,
            "Cloth Travel Bag",
            "Embark on your journeys with our durable and stylish cloth travel bag, designed for both functionality and fashion.",
            "cloth_travel_bag.png"
        ),
        (
            @last_prod_id + 2,
            "Crocheted Flower Buds",
            "Bring a touch of handmade warmth to your space with our crocheted flower buds, delicate and charming accents to elevate your decor.",
            "crocheted_flower_buds.png"
        ),
        (
            @last_prod_id + 3,
            "Flower Glass Vase",
            "Elevate your space with our upcycled glass vase and blooming flowers, a sustainable fusion of art and nature.",
            "flower_glass_vase.png"
        ),
        (
            @last_prod_id + 4,
            "Handpainted Plates",
            "Elevate your dining experience with our exquisite hand-painted plates, where artistry meets functionality for a touch of elegance on your table.",
            "handpainted_plates.png"
        ),
        (
            @last_prod_id + 5,
            "Hanging Heart Chimes",
            "Create a symphony of love in your surroundings with our hanging heart chimes—a harmonious blend of whimsical design and soothing melodies.",
            "hanging_heart_chimes.png"
        ),
        (
            @last_prod_id + 6,
            "Indoor Plastic Flowerpots",
            "Infuse eco-conscious style into your home with our upcycled plastic indoor flowerpots, transforming discarded materials into vibrant, sustainable plant sanctuaries.",
            "indoor_plastic_flowerpots.png"
        ),
        (
            @last_prod_id + 7,
            "Reusable Coffee Mugs",
            "Sip sustainably with our reusable coffee mugs, the perfect blend of style and eco-consciousness for your daily brew on the go.",
            "reusable_coffee_mugs.png"
        );
SQL;
