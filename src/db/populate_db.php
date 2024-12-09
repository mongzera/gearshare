<?php

function connect_db(){
    $host = 'localhost';
    $dbname = 'ecommerce_db';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully"; 
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $pdo;
}

function specialChars($value){
    return htmlspecialchars($value);
}

function insertItemToDb($item_name, $item_description, $item_price, $item_category, $item_brand){
    $pdo = connect_db();

    $sql = "INSERT INTO tb_items (name, description, price, category, brand) VALUES (:name, :description, :price, :category, :brand)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $item_name,
        ':description' => $item_description,
        ':price' => $item_price,
        ':category' => $item_category,
        ':brand' => $item_brand
    ]);
}

$bikeAccessories = [
    ['Bike Helmet', 'Protective headgear designed for cycling safety.', 59.99, 'Safety Gear', 'Bell'],
    ['Cycling Gloves', 'Padded gloves for grip and comfort while riding.', 29.99, 'Apparel', 'Pearl Izumi'],
    ['Bike Lock', 'Heavy-duty lock to secure your bike when parked.', 24.99, 'Security', 'Kryptonite'],
    ['Bike Pump', 'Handheld pump for inflating bike tires.', 19.99, 'Tools', 'Topeak'],
    ['Water Bottle Holder', 'Mounts on the bike frame to hold water bottles.', 14.99, 'Accessories', 'Bontrager'],
    ['Multi-Tool', 'Compact tool with multiple functions for bike repairs.', 39.99, 'Tools', 'Crank Brothers'],
    ['Bike Lights', 'Front and rear lights for visibility at night.', 34.99, 'Safety Gear', 'Cygolite'],
    ['Tire Repair Kit', 'Includes patches and tools for fixing flat tires.', 9.99, 'Tools', 'Park Tool'],
    ['Cycling Shorts', 'Padded shorts for comfort during long rides.', 49.99, 'Apparel', 'Shimano'],
    ['Handlebar Tape', 'Grips that enhance comfort and control.', 15.99, 'Accessories', 'Lizard Skins'],
    ['Chain Lubricant', 'Oil to keep the bike chain running smoothly.', 9.99, 'Maintenance', 'Muc-Off'],
    ['Bike Bag', 'Storage bag for tools, snacks, and personal items.', 29.99, 'Accessories', 'Dakine'],
    ['Frame Pump', 'Lightweight pump that fits on the bike frame.', 19.99, 'Tools', 'Blackburn'],
    ['Cycling Shoes', 'Special shoes for better pedal grip and efficiency.', 89.99, 'Apparel', 'Giro'],
    ['Reflective Vest', 'High-visibility vest for riding in low light.', 24.99, 'Safety Gear', 'Planet Bike'],
    ['Bike Computer', 'Digital device to track speed, distance, and time.', 49.99, 'Electronics', 'CatEye'],
    ['Bike Stand', 'A stand for holding the bike upright while working on it.', 89.99, 'Tools', 'Park Tool'],
    ['Pedals', 'Replacement pedals for better grip and performance.', 29.99, 'Parts', 'Shimano'],
    ['Seat Post', 'Adjustable post for customizing seat height.', 39.99, 'Parts', 'Race Face'],
    ['Brake Pads', 'Replacement pads for ensuring effective braking.', 19.99, 'Parts', 'SRAM'],
    ['Gear Shifters', 'Controls for shifting gears on the bike.', 89.99, 'Parts', 'Shimano'],
    ['Bicycle Frame', 'The main structure of the bike; various sizes and materials available.', 299.99, 'Parts', 'Trek'],
    ['Tires', 'Replacement tires with various tread patterns.', 39.99, 'Parts', 'Continental'],
    ['Fenders', 'Shields that protect the rider from mud and water.', 29.99, 'Accessories', 'SKS'],
    ['Bell', 'Alerting device for pedestrians and other cyclists.', 14.99, 'Safety Gear', 'Mirrycle'],
    ['Mountain Bike', 'Durable bike for off-road trails.', 500, 'Bikes', 'Trek'],
    ['Road Bike', 'Lightweight bike for speed on paved roads.', 800, 'Bikes', 'Specialized'],
    ['Hybrid Bike', 'Versatile bike for both commuting and leisure.', 600, 'Bikes', 'Cannondale'],
    ['BMX Bike', 'Stunt bike for tricks and racing on tracks.', 300, 'Bikes', 'Mongoose'],
    ['Electric Bike', 'Motor-assisted bike for easier rides.', 1200, 'Bikes', 'Rad Power Bikes'],
    ['Bike Helmet', 'Protective gear for cyclists.', 60, 'Accessories', 'Bell'],
    ['Bike Lock', 'Heavy-duty lock to secure your bike.', 35, 'Accessories', 'Kryptonite'],
    ['Bike Lights', 'Front and rear lights for night riding safety.', 25, 'Accessories', 'Cygolite'],
    ['Bike Pump', 'Hand pump for inflating tires on the go.', 20, 'Tools', 'Topeak'],
    ['Repair Tool Kit', 'Essential tools for bike maintenance and repairs.', 40, 'Tools', 'Park Tool'],
    ['Water Bottle Holder', 'Mount for securely holding water bottles.', 15, 'Accessories', 'Blackburn'],
    ['Bike Tires', 'High-performance tires for improved grip.', 50, 'Parts', 'Continental'],
    ['Chain Lubricant', 'Keeps bike chain running smoothly.', 10, 'Maintenance', 'Finish Line'],
    ['Handlebar Grips', 'Comfortable grips for better control.', 25, 'Parts', 'Ergon'],
    ['Bike Racks', 'Mount for carrying bikes on vehicles.', 150, 'Accessories', 'Thule'],
    ['Cycling Shorts', 'Padded shorts for comfort during long rides.', 40, 'Apparel', 'Pearl Izumi'],
    ['Cycling Jersey', 'Breathable jersey for moisture-wicking comfort.', 50, 'Apparel', 'Castelli'],
    ['Bicycle Bell', 'Alerts pedestrians and other cyclists.', 10, 'Accessories', 'Mirrycle'],
    ['Fenders', 'Protects against water and mud while riding.', 40, 'Accessories', 'SKS'],
    ['Bike Seat', 'Comfortable replacement seat for longer rides.', 30, 'Parts', 'Selle Italia']
];

foreach($bikeAccessories as $instance){
    insertItemToDb(specialChars($instance[0]), specialChars($instance[1]), specialChars($instance[2]), specialChars($instance[3]), specialChars($instance[4]));
}