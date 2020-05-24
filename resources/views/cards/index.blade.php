<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    
    
</head>
<body>

    <!--Start Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('CardController@store') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" class="form-control" placeholder="Enter Card Number">
                    </div>

                    <div class="form-group">
                        <label>PIN</label>
                        <input type="text" name="pin" class="form-control" placeholder="Enter PIN">
                    </div>

                    <div class="form-group">
                        <label>Activation Date</label>
                        <input type="text" name="activation_date" id="datePicker" class="date form-control" placeholder="Enter Activation Date">
                    </div>

                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control" placeholder=" Enter Expiry Date">
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter Amount">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Card</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--End Add Modal -->

    <!--Start Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/" method="POST" id="editForm">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter Card Number">
                    </div>

                    <div class="form-group">
                        <label>PIN</label>
                        <input type="text" name="pin" id="pin" class="form-control" placeholder="Enter PIN">
                    </div>

                    <div class="form-group">
                        <label>Activation Date</label>
                        <input type="text" name="activation_date" id="activation_date" class="date form-control" placeholder="Enter Activation Date">
                    </div>

                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder=" Enter Expiry Date">
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Card</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--End Edit Modal -->

    <!--Start Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/" method="POST" id="deleteForm">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-body">

                    <input type="hidden" name="_method" value="DELETE">
                    <p> Are you sure?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete Card</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--End Delete Modal -->

    @if(session()->has('message'))
                        
        <div class="alert alert-success">{{session()->get('message')}}</div>
    
    @elseif(session()->has('error'))
    
        <div class="py-4 px-2 bg-red-400">{{session()->get('error')}}</div>
    
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="col-12 col-sm-12 col-md-10 offset-md-1">
            
            <div style="text-align: center; margin-top: 5%;">
                <h1>Card CRUD</h1>
            </div>
            <div style="text-align: center; margin-top: 5%; margin-bottom: 5%;">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" onclick="setDate()" data-target="#addModal">
                Add Card
                </button>
            </div>
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-dark table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col">ID</th>
                            <th scope="col">Number</th>
                            <th scope="col">PIN</th>
                            <th scope="col">Activation Date</th>
                            <th scope="col">Expiration Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cards as $card)
                            <tr style="text-align: center;">
                                <th scope="row">{{ $card->id }}</th>
                                <td>{{ $card->card_number }}</td>
                                <td>{{ $card->pin }}</td>
                                <td>{{ $card->activation_date }}</td>
                                <td>{{ $card->expiry_date }}</td>
                                <td>{{ $card->amount }}</td>
                                <th><a class="btn btn-success edit">Edit</a></th>
                                <th><a class="btn btn-danger delete">Delete</a></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>





<script>

    $(document).ready(function() {


        let table = $('#dataTable').DataTable();

        table.on('click', '.edit', function() {

            $tr = $(this).closest('tr');

            if( $($tr).hasClass('child') ){
                $tr = $tr.prev('.parent');
            }

            let data = table.row($tr).data();


            $('#card_number').val(data[1]);
            $('#pin').val(data[2]);
            $('#activation_date').val(data[3]);
            $('#expiry_date').val(data[4]);
            $('#amount').val(data[5]);

            $('#editForm').attr('action', '/cards/' + data[0]);
            $('#editModal').modal('show');

        });

        table.on('click', '.delete', function() {

            $tr = $(this).closest('tr');

            if( $($tr).hasClass('child') ) {
                $tr = $tr.prev('.parent');
            }

            let data = table.row($tr).data();

            $('#deleteForm').attr('action', '/cards/' + data[0]);
            $('#deleteModal').modal('show');
        });

    });

    function setDate(){
        let date = new Date();

        let day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear(),
            hour = date.getHours(),
            min  = date.getMinutes();

        month = (month < 10 ? "0" : "") + month;
        day = (day < 10 ? "0" : "") + day;
        hour = (hour < 10 ? "0" : "") + hour;
        min = (min < 10 ? "0" : "") + min;

        let today = year + "-" + month + "-" + day,
            time = hour + ":" + min; 
        let now = today + " " + time;

        document.getElementById("datePicker").value = now;
    }
    
</script>
</body>
</html>