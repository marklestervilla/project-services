<div class="row">
                                    <input type="hidden" name="id" value="<?php echo $projectId; ?>">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="file" class="form-label">Upload Project File</label>
                                            <input type="file" class="form-control" name="file" id="file">
                                        </div>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <div class="form-group">
                                            <label for="project_name" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" name="project_name" id="project_name">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Select Category:</label>
                                        <select name="category_id" class="form-select mySelect2">
                                            <option value="" selected disabled>Select Category</option>
                                            <?php
                                            $categories = getAll('categories');
                                            if ($categories && mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $cateItem) {
                                                    echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="">No Category Found!</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea name="description" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="">Address *</label>
                                            <textarea id="summernote" name="address" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Project Manager</label>
                                        <?php
                                        $available_managers_query = "SELECT * FROM employee WHERE position='Project Manager' AND name NOT IN (SELECT DISTINCT position FROM files)";
                                        $available_managers_run = mysqli_query($con, $available_managers_query);

                                        if (mysqli_num_rows($available_managers_run) > 0) {
                                            ?>
                                            <select name="position" required class="form-control">
                                                <option value="" selected disabled>--Select Manager--</option>
                                                <?php
                                                foreach ($available_managers_run as $manager) {
                                                    ?>
                                                    <option value="<?= $manager['name'] ?>"><?= $manager['name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        <?php
                                        } else {
                                            ?>
                                            <option value="" disabled>No Available Project Manager</option>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="">Date Start</label>
                                            <input type="date" name="date_start" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="">Due Date</label>
                                            <input type="date" name="due_date" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select name="status" class="form-control">
                                                <option value="0">Started</option>
                                                <option value="1">On-Progress</option>
                                                <option value="2">Done</option>
                                                <option value="3">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>