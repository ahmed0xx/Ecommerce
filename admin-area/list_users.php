 <h3 class="text-center">All Users</h3>
 <table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_users = "SELECT * FROM `users`";
        $result = mysqli_query($conn,$get_users);
        
            echo "<tr>
            <th>id</th>
            <th>Username</th>
            <th>User Email</th>
            <th>Delete</th>
            </tr>
            </thead>
            <tbody>";
            while($row_count = mysqli_fetch_assoc($result)){
                if($row_count == 0){
            echo "<h2 class='text-danger text-center mt-4'>No users yet</h2>";
                }
                $user_id =$row_count['user_id'];
                $user_name =$row_count['user_name'];
                $user_email =$row_count['user_email'];
                echo"
                <tr>
                <td>$user_id</td>
                <td>$user_name</td>
                <td>$user_email</td>
                <td><a href='index.php?id=$user_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";   
            }
        ?>

    </thead>
 </table>