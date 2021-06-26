 
 <!-- Sidebar -->

 <div class="col-md-4">





             <div class="well">

                 <?php if(isset($_SESSION['login'])): ?>

                        <h4>Logged in as <b><?php echo $_SESSION['username']; ?></b></h4>
                        <hr>
                        <form action="./includes/logout.php" method="POST">
                              <div class="form-group">
                                <button name ="logout" type="submit" class="btn btn-danger">Logout</button>
                              </div>
                        </form>

                 <?php else: ?>

                    <h4>Login</h4>
                        <hr>
                        <form action="./includes/login.php" method="POST">
                              <div class="form-group">
                                <label for="user_email">Email address</label>
                                <input type="email" name="user_email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                              </div>
                              <div class="form-group">
                                <button name ="login" type="submit" class="btn btn-primary">Login</button>
                              </div>
                        </form>

                 <?php endif; ?>

            </div>



                    <!-- Unused html -->
                    <!-- <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->






                <!-- Blog Search Well -->

                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                    <form action="search.php" method="POST">
                        <input name="search-box" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </form>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php 

                                    const COUNT = 4;

                                    $query = "SELECT * FROM category";
                                    $all_category_rows = mysqli_query($conn, $query);

                                    $num_rows_count = mysqli_num_rows($all_category_rows);

                                    $i = 0;
                                    while($i < COUNT && $row = mysqli_fetch_assoc($all_category_rows))
                                    {
                                        $i++;
                                        echo '<li><a href="#">'. $row['cat_title'] . '</a></li>';
                                    }
                    
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                    $i = 0;
                                    while($i < COUNT && $row = mysqli_fetch_assoc($all_category_rows))
                                    {
                                        $i++;
                                        echo '<li><a href="#">'. $row['cat_title'] . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
 </div>