<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product - LavaLust</title>

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

        /* NAVBAR */

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

        /* MAIN CONTAINER */

        .container {
            width: 75%;
            max-width: 700px;
            margin: 45px auto;
        }

        /* PAGE HEADER */

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 27px;
            margin-bottom: 7px;
        }

        .page-header p {
            color: #777777;
            font-size: 13px;
        }

        /* CARD */

        .card {
            background: #101010;
            border: 1px solid #292929;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 22px;

            border-bottom: 1px solid #292929;

            font-size: 14px;
            font-weight: bold;
        }

        .card-body {
            padding: 25px;
        }

        /* FORM */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            color: #dddddd;

            font-size: 12px;
            font-weight: bold;

            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;

            background: #171717;

            border: 1px solid #303030;

            border-radius: 6px;

            color: #ffffff;

            padding: 11px 12px;

            font-size: 13px;

            outline: none;

            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #ff5a1f;

            box-shadow: 0 0 0 2px rgba(255, 90, 31, 0.10);
        }

        .form-control::placeholder {
            color: #555555;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* PRODUCT ID */

        .product-id {
            display: inline-block;

            margin-bottom: 20px;

            padding: 5px 9px;

            background: #1c1c1c;

            border: 1px solid #303030;

            border-radius: 5px;

            color: #ff5a1f;

            font-size: 11px;
            font-weight: bold;
        }

        /* BUTTONS */

        .buttons {
            display: flex;
            gap: 10px;

            margin-top: 25px;
        }

        .btn {
            border: none;

            padding: 11px 18px;

            border-radius: 6px;

            font-size: 12px;
            font-weight: bold;

            text-decoration: none;

            cursor: pointer;
        }

        .btn-primary {
            background: #ff5a1f;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #ff6b35;
        }

        .btn-secondary {
            background: #303030;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: #444444;
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {

            .container {
                width: 92%;
            }

            .navbar {
                padding: 0 4%;
            }

        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <div class="logo">
            Lava<span>Lust</span>
        </div>

        <a
            href="<?= site_url('products') ?>"
            class="nav-link"
        >
            Products
        </a>

    </nav>


    <!-- MAIN CONTENT -->

    <main class="container">

        <div class="page-header">

            <h1>Edit Product</h1>

            <p>
                Update the information of this product.
            </p>

        </div>


        <!-- EDIT PRODUCT CARD -->

        <div class="card">

            <div class="card-header">
                Product Information
            </div>


            <div class="card-body">

                <div class="product-id">
                    Product #<?= htmlspecialchars($product['id']) ?>
                </div>


                <form
                    method="POST"
                    action="<?= site_url('products/update/' . $product['id']) ?>"
                >

                    <!-- PRODUCT NAME -->

                    <div class="form-group">

                        <label for="product_name">
                            Product Name
                        </label>

                        <input
                            type="text"
                            id="product_name"
                            name="product_name"
                            class="form-control"
                            value="<?= htmlspecialchars($product['product_name']) ?>"
                            maxlength="100"
                            required
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                        ><?= htmlspecialchars($product['description']) ?></textarea>

                    </div>


                    <!-- PRICE -->

                    <div class="form-group">

                        <label for="price">
                            Price
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            class="form-control"
                            value="<?= htmlspecialchars($product['price']) ?>"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    <!-- QUANTITY -->

                    <div class="form-group">

                        <label for="quantity">
                            Quantity
                        </label>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            class="form-control"
                            value="<?= htmlspecialchars($product['quantity']) ?>"
                            min="0"
                            required
                        >

                    </div>


                    <!-- BUTTONS -->

                    <div class="buttons">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Save Changes
                        </button>


                        <a
                            href="<?= site_url('products') ?>"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</body>

</html>