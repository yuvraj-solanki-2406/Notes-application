<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuvraj Notes</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</head>

<body>

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light m-2">
            <div class="container-fluid">
                <a class="navbar-brand p-2 mx-5" href="#">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShO1gHYoCzYIvT7Gmp7XLqA2wMk2m6RMg4TQ&usqp=CAU" alt="logo" 
                    width="180" height="150" class="d-inline-block align-text-top ml-5">
                </a>
                <div class="container">
                    <span style="font-size: 42px;">Yuvraj Notes</span>
                </div>
            </div>
        </nav>

        <?php
        if ($update) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your note has been updated successfully
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
            </button>
            </div>";
        }
        ?>

        <?php
        if ($insert) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your note has been inserted successfully
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
            </button>
            </div>";
        }
        ?>

        <?php
        if ($delete) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your note has been deleted successfully
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
            </button>
            </div>";
        }
        ?>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/CRUD/indes.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Note Heading</label>
                            <input type="text" class="form-control mt-1" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" placeholder="Enter Note Heading">
                        </div>
                        <div class="form-group mt-2">
                            <label for="desc">Describe Note</label>
                            <textarea class="form-control mt-1" rows="3" id="descriptionEdit" name="descriptionEdit" placeholder="Write your note here"></textarea>
                        </div>

                        <button type="submit" class="btn btn-info mt-3">Submit</button>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container col-md-6 mt-3">
        <form action="/CRUD/indes.php" method="POST" class="mt-5 mb-5">
            <div class="form-group mt-3">
                <label for="exampleInputEmail1">Note Heading</label>
                <input type="text" class="form-control mt-1" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter Note Heading" required>
            </div>
            <div class="form-group mt-2">
                <label for="desc">Note Description</label>
                <textarea class="form-control mt-1" id="desc" rows="3" name="description" placeholder="Write your note here" required></textarea>
            </div>

            <button type="submit" class="btn btn-outline-primary btn-lg col-md-12 mt-3">Submit</button>
        </form>
    </div>

    <div class="col-md-10 mt-5 mb-5 border" style="margin-left:auto; margin-right: auto;">
        <table class="table table-bordered table-hover mt-4" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Note Id</th>
                    <th scope="col">Note Title</th>
                    <th scope="col">Note Description</th>
                    <th scope="col">Date and Time </th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `user_notes`";
                $result = mysqli_query($conn, $sql);
                $serial = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $serial++;
                    echo " 
                    <tr>
                        <th scope='row'>" . $serial . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['date_time'] . "</td>
                        <td> <button class='btn btn-primary edits' id=" . $row['Id'] . ">Update Note</button> </td>
                        <td> <button class='btn btn-danger deletes' id=d" . $row['Id'] . ">Delete Note</button>  </td>    
                    </tr> ";
                }
                ?>
            </tbody>
        </table>

    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        edits = document.getElementsByClassName('edits');
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                console.log('edits', e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                desc = tr.getElementsByTagName('td')[1].innerText;
                console.log(title, desc);
                titleEdit.value = title;
                descriptionEdit.value = desc;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle')
            })
        })

        deletes = document.getElementsByClassName('deletes');
        Array.from(deletes).forEach((element) => {
            element.addEventListener('click', (e) => {
                console.log('deletes', e.target.parentNode.parentNode);
                sno = e.target.id.substr(1, );

                if (confirm('Are you sure to delete the Note? ')) {
                    console.log('yes');
                    window.location = `/CRUD/indes.php?delete=${sno}`;
                } else {
                    console.log('no');
                }
            })
        })
    </script>



</body>

</html>