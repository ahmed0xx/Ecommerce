<h3 class="text-center">All products</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr>
            <th>Product ID</th>
            <th>Product title</th>
            <th>Product image</th>
            <th>Product Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select_query = "SELECT * FROM `products`";
        $result_query = mysqli_query($conn,$select_query);
        while($row = mysqli_fetch_assoc($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_image = $row['product_image1'];
            $product_price = $row['product_price'];
            echo "
            <tr class='text-center'>
            <td>$product_id</td>
            <td>$product_title</td>
            <td><img style='width: 100px;' src='./product_images/$product_image'></td>
            <td>$product_price</td>
            <td><a href='index.php?edit=$product_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete=$product_id'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
            ";
        }

        ?>

    </tbody>
</table>
