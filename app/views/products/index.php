<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #080808;
            color: #ffffff;
            min-height: 100vh;

            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);

            background-size: 48px 48px;
        }

        .navbar {
            height: 82px;
            border-bottom: 1px solid #1c1c1c;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            background: rgba(8, 8, 8, 0.95);
        }

        .logo {
            font-size: 18px;
            font-weight: bold;
        }

        .logo span {
            color: #ff5a1f;
        }

        .nav-link {
            color: #a1a1a1;
            text-decoration: none;
            font-size: 13px;
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .container {
            width: 75%;
            max-width: 1100px;
            margin: 45px auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 27px;
            margin-bottom: 7px;
        }

        .page-title p {
            color: #777777;
            font-size: 13px;
        }

        .add-btn {
            background: #ff5a1f;
            color: #ffffff;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #ff6b35;
        }

        .card {
            background: #101010;
            border: 1px solid #292929;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-title {
            padding: 16px;
            border-bottom: 1px solid #292929;
            font-size: 14px;
            font-weight: bold;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #151515;
            color: #777777;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #292929;
        }

        td {
            padding: 14px 13px;
            font-size: 12px;
            color: #dddddd;
            border-bottom: 1px solid #202020;
        }

        tbody tr:hover {
            background: #151515;
        }

        .id {
            color: #ff5a1f;
            font-weight: bold;
        }

        .product-name {
            color: #ffffff;
            font-weight: bold;
        }

        .description {
            color: #999999;
            max-width: 230px;
        }

        .price {
            color: #ffffff;
            font-weight: bold;
        }

        .quantity {
            color: #cccccc;
        }

        .created {
            color: #777777;
            white-space: nowrap;
        }

        .actions {
            white-space: nowrap;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 10px;
            font-weight: bold;
            margin-right: 3px;
        }

        .edit-btn {
            background: #303030;
            color: #ffffff;
        }

        .edit-btn:hover {
            background: #444444;
        }

        .delete-btn {
            background: #351b16;
            color: #ff5a1f;
        }

        .delete-btn:hover {
            background: #4a2119;
        }

        .empty {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-icon {
            font-size: 38px;
            margin-bottom: 12px;
        }

        .empty h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .empty p {
            color: #777777;
            font-size: 12px;
            margin-bottom: 20px;
        }

        @media (max-width: 800px) {

            .container {
                width: 92%;
            }

            .navbar {
                padding: 0 4%;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .add-btn {
                display: inline-block;
            }

        }

    </style>

</head>

<body>

    <nav class="navbar">

        <div class="logo">
            Lava<span>Lust</span>
        </div>

        <a href="<?= site_url('products') ?>" class="nav-link">
            Products
        </a>

    </nav>


    <main class="container">

        <div class="page-header">

            <div class="page-title">

                <h1>Product Management</h1>

                <p>
                    Manage products stored in the system.
                </p>

            </div>

            <a
                href="<?= site_url('products/create') ?>"
                class="add-btn"
            >
                + Add Product
            </a>

        </div>


        <div class="card">

            <div class="card-title">
                Products
            </div>


            <?php if (!empty($products)): ?>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>PRODUCT NAME</th>

                                <th>DESCRIPTION</th>

                                <th>PRICE</th>

                                <th>QUANTITY</th>

                                <th>CREATED AT</th>

                                <th>ACTIONS</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($products as $product): ?>

                                <tr>

                                    <td class="id">
                                        <?= htmlspecialchars($product['id']) ?>
                                    </td>

                                    <td class="product-name">
                                        <?= htmlspecialchars($product['product_name']) ?>
                                    </td>

                                    <td class="description">
                                        <?= htmlspecialchars($product['description']) ?>
                                    </td>

                                    <td class="price">
                                        ₱<?= number_format((float)$product['price'], 2) ?>
                                    </td>

                                    <td class="quantity">
                                        <?= htmlspecialchars($product['quantity']) ?>
                                    </td>

                                    <td class="created">
                                        <?= htmlspecialchars($product['created_at']) ?>
                                    </td>

                                    <td class="actions">

                                        <a
                                            href="<?= site_url('products/edit/' . $product['id']) ?>"
                                            class="edit-btn"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="<?= site_url('products/delete/' . $product['id']) ?>"
                                            class="delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this product?');"
                                        >
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="empty">

                    <div class="empty-icon">
                        📦
                    </div>

                    <h3>
                        No Products Found
                    </h3>

                    <p>
                        There are currently no products in the database.
                    </p>

                    <a
                        href="<?= site_url('products/create') ?>"
                        class="add-btn"
                    >
                        + Add Product
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </main>

</body>
</html>