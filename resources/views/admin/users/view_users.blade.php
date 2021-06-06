@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Users</a>  </div>
    <h1>Users</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
      
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Address</th>
                  <th>Pincode</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Banned</th>
                  <th>Registered on</th>
                </tr>
              </thead>
              <tbody>
            
                @foreach($users as $user)   
                         
                <tr class="gradeX">
                  <td class="center">{{ $user->id }}</td>
                  <td class="center">{{ $user->name }}</td>
                  <td class="center">{{ $user->last_name }}</td>
                  <td class="center">{{ $user->country }}</td>
                  <td class="center">{{ $user->city }}</td>
                  <td class="center">{{ $user->state }}</td>
                  <td class="center">{{ $user->address }}</td>
                  <td class="center">{{ $user->pincode }}</td>
                  <td class="center">{{ $user->email }}</td>
                  <td class="center">{{ $user->mobile }}</td>
                  <td class="center"> @if($user->status == 1) <span style="color:green">Active</span> @else <span style="color:red">Inactive</span> @endif </td>   
                  <td class="center">
                    <input type="hidden" id="userID{{$user->id}}" value="{{$user->id}}">
                    <select class="form-control" id="loginStatus{{$user->id}}">
                      <option value="">Select an option</option>
                      <option  value="0">No</option>
                      <option  value="1">Yes</option>                                             
                    </select>
                    <br> 
                    <div id="successMsg{{$user->id}}" class="alert alert-success" style="width:220px;"></div>  
                  </td>                                                    
                  <td class="center">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    @foreach($users as $user)
    $('#successMsg{{$user->id}}').hide();
    $("#loginStatus{{$user->id}}").change(function(){
      var status=$("#loginStatus{{$user->id}}").val();
      var userID=$("#userID{{$user->id}}").val()
      if(status==""){
    alert("Please select an option");
  }else{

    $.ajax({
     url: '{{url("/admin/banUser")}}',
     data: 'status=' + status + '&userID=' + userID,
     type: 'get',
     success:function(response){
      $('#successMsg{{$user->id}}').show();
       console.log(response);   
       $('#successMsg{{$user->id}}').html(response);
     }
   });

  }


    });
    @endforeach
  });
</script>


@endsection