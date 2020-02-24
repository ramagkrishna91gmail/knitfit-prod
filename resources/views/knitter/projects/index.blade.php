@extends('layouts.knitterapp')
@section('title','Knitter Project Library')
@section('content')

<div class="pcoded-wrapper">
<div class="pcoded-content">
  <div class="pcoded-inner-content">
     <div class="main-body">
        <div class="page-wrapper">
           <!-- Page-body start -->
<div class="page-body">
  <div class="row">
     <div class="col-xl-4">
        <h5 class="theme-heading"><a href="Create-Project.html"><i class="fa fa-home theme-heading m-r-10"></i></a> Project Library </h5>
     </div>
     <div class="col-xl-8 text-right tabber">
        <a href="{{url('knitter/create-project')}}" class="btn btn-theme tablike-bt-fill waves-effect">Create Project</a>
        <a href="{{url('knitter/project-library/archive')}}" class="btn btn-default tablike-bt-outlined waves-effect">My Archive</a>
        <!--a href="#!" class="btn btn-default tablike-bt-outlined waves-effect">Notes</!--a>
           <a href="#!" class="btn btn-default tablike-bt-fill waves-effect">Progress</a> -->
     </div>
  </div>
  <div class="row m-t-30">
     <!--Not Started Starts here-->
     <div class="col-lg-3 col-xl-3">
        <!-- Draggable Without Images card start -->
        <h5 class="card-header-text m-b-20 text-muted">New patterns</h5>
        <div class="card-block">
           <div class="row">
            @if($orders->count() > 0)
              <ul >
@foreach($orders as $ord)
<li>
  <div class="col-md-12 m-b-20">
      <div class="card-sub-custom">
          <div class="card-block">
              <div class="row">
             <div class="col-lg-4"><img class="img-fluid" src="{{ $ord->image_medium }}" style="height: 100px;" alt="round-img"></div>
             <div class="col-lg-8"><h6 class="card-title">{{ucfirst($ord->product_name)}}</h6>     
      </div>
          </div>
              </div>
              <div class="card-footer-custom">
                  <div class="dropdown-secondary dropdown text-right">
                      <span class="m-r-60"><i class="fa fa-calendar-check-o text-muted m-r-10 f-12"></i><span class="text-muted f-12">{{date('d M,Y',strtotime($ord->created_at))}}</span></span>
                   <button class="btn-vert-toggle text-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options-vertical"></i></button>
                   <div class="dropdown-menu notifications" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                       <a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#myModal"> Post on the wall</a>
                       <a class="dropdown-item waves-light waves-effect note" href="#!" data-type="success" data-from="top" data-animation-in="animated fadeInRight" data-animation-out="animated fadeOutRight" >Add To archive</a>
                       
                   </div>
                   <!-- end of dropdown menu -->
               </div>
           </div>
      </div>
  </div>
</li>
@endforeach
              </ul>
              @else
          <p>No available orders</p>
              @endif
           </div>
        </div>
        <!-- Draggable Without Images card end -->
     </div>
     <!--Not Started Ends here-->
     <!--In Progress Starts Here-->
     <div class="col-lg-3 col-xl-3">
        <!-- Draggable Without Images card start -->
        <h5 class="card-header-text m-b-20 text-muted">Generated Patterns</h5>
        <div class="card-block">
           <div class="row">
           
              <ul  id="sortable2" class='droptrue'>
                 @if($generatedpatterns->count() > 0)
                @foreach($generatedpatterns as $gp)
                <?php 
                $image = App\Project::find($gp->pid)->project_images()->first();
                ?>
                 <li class="" id="generatedpatterns{{$gp->pid}}" data-id="{{$gp->pid}}">
                    <div class="col-md-12 m-b-20">
                       <div class="card-sub-custom">
                          <div class="card-block">
                             <div class="row">
                                <div class="col-lg-4"><img class="img-fluid" src="{{ $image->image_path }}" style="height: 100px;" alt="round-img"></div>
                                <div class="col-lg-8">
                                   <h6 class="card-title">{{ucfirst($gp->name)}}</h6>
                                </div>
                             </div>
                          </div>
                          <div class="card-footer-custom">
                             <div class="dropdown-secondary dropdown text-right">
                                <span class="m-r-60"><i class="fa fa-calendar-check-o text-muted m-r-10 f-12"></i><span class="text-muted f-12" id="date{{$gp->pid}}">{{date('d M, Y',strtotime($gp->updated_at))}}</span></span>
                                <button class="btn-vert-toggle text-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options-vertical"></i></button>
                                <div class="dropdown-menu notifications" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                  <!-- <a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#myModal"> Post on the wall</a> -->
                                   <a class="dropdown-item waves-light waves-effect note moveToArchive" href="javascript:;" data-type="success" data-from="top" data-animation-in="animated fadeInRight" data-animation-out="animated fadeOutRight" data-id="{{$gp->pid}}" >Add To archive</a>
                                   <a class="dropdown-item waves-light waves-effect deleteAction" data-toggle="modal" data-id="{{$gp->pid}}" data-target="#delete-Modal"> Delete</a>
                                </div>
                                <!-- end of dropdown menu -->
                             </div>
                          </div>
                       </div>
                    </div>
                 </li>
                 @endforeach
                 @endif
              </ul>
              
           </div>
        </div>
        <!-- Draggable Without Images card end -->
     </div>
     <!--In Progress Ends here-->
     <!--Completed Starts here-->
     <div class="col-lg-3 col-xl-3">
        <!-- Draggable Without Images card start -->
        <h5 class="card-header-text m-b-20 text-muted">Work in Progress</h5>
        <div class="card-block">
           <div class="row">
              
              <ul  id="sortable3" class='droptrue'>
                @if($workinprogress->count() > 0)
                @foreach($workinprogress as $wp)
                <?php 
                $image2 = App\Project::find($wp->pid)->project_images()->first();
                ?>
                 <li class="" id="workinprogress{{$wp->pid}}" data-id="{{$wp->pid}}">
                    <div class="col-md-12 m-b-20">
                       <div class="card-sub-custom">
                          <div class="card-block">
                             <div class="row">
                                <div class="col-lg-4"><img class="img-fluid" src="{{ $image2->image_path }}" style="height: 100px;" alt="round-img"></div>
                                <div class="col-lg-8">
                                   <h6 class="card-title">{{ucfirst($wp->name)}}</h6>
                                </div>
                             </div>
                          </div>
                          <div class="card-footer-custom">
                             <div class="dropdown-secondary dropdown text-right">
                                <span class="m-r-60"><i class="fa fa-calendar-check-o text-muted m-r-10 f-12"></i><span class="text-muted f-12" id="date{{$wp->pid}}" >{{date('d M, Y',strtotime($wp->updated_at))}}</span></span>
                                <button class="btn-vert-toggle text-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options-vertical"></i></button>
                                <div class="dropdown-menu notifications" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                   <a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#myModal"> Post on the wall</a>
                                   <a class="dropdown-item waves-light waves-effect note moveToArchive" href="javascript:;" data-type="success" data-from="top" data-animation-in="animated fadeInRight" data-animation-out="animated fadeOutRight" data-id="{{$wp->pid}}" >Add To archive</a>
                                   <a class="dropdown-item waves-light waves-effect deleteAction" data-toggle="modal" data-id="{{$wp->pid}}" data-target="#delete-Modal"> Delete</a>
                                </div>
                                <!-- end of dropdown menu -->
                             </div>
                          </div>
                       </div>
                    </div>
                 </li>
                 @endforeach
              @endif
              </ul>
           </div>
        </div>
        <!-- Draggable Without Images card end -->
     </div>
     <!--Completed Ends here-->
     <!--Completed Starts here-->
     <div class="col-lg-3 col-xl-3">
        <!-- Draggable Without Images card start -->
        <h5 class="card-header-text m-b-20 text-muted">Completed</h5>
        <div class="card-block">
           <div class="row">
              
              <ul  id="sortable4" class='droptrue'>
                @if($completed->count() > 0)
                @foreach($completed as $com)
                <?php 
                $image3 = App\Project::find($com->pid)->project_images()->first();
                ?>
                 <li class="" id="completed{{$com->pid}}" data-id="{{$com->pid}}">
                    <div class="col-md-12 m-b-20">
                       <div class="card-sub-custom">
                          <div class="card-block">
                             <div class="row">
                                <div class="col-lg-4"><img class="img-fluid" src="{{ $image3->image_path }}" style="height: 100px;" alt="round-img"></div>
                                <div class="col-lg-8">
                                   <h6 class="card-title">{{ucfirst($com->name)}}</h6>
                                </div>
                             </div>
                          </div>
                          <div class="card-footer-custom">
                             <div class="dropdown-secondary dropdown text-right">
                                <span class="m-r-60"><i class="fa fa-calendar-check-o text-muted m-r-10 f-12"></i><span class="text-muted f-12" id="date{{$com->pid}}">{{date('d M, Y',strtotime($com->updated_at))}}</span></span>
                                <button class="btn-vert-toggle text-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-options-vertical"></i></button>
                                <div class="dropdown-menu notifications" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                   <a class="dropdown-item waves-light waves-effect" data-toggle="modal" data-target="#myModal"> Post on the wall</a>
                                   <a class="dropdown-item waves-light waves-effect note moveToArchive" href="javascript:;" data-type="success" data-from="top" data-animation-in="animated fadeInRight" data-animation-out="animated fadeOutRight" data-id="{{$com->pid}}" >Add To archive</a>
                                   <a class="dropdown-item waves-light waves-effect deleteAction" data-toggle="modal" data-id="{{$com->pid}}" data-target="#delete-Modal"> Delete</a>
                                </div>
                                <!-- end of dropdown menu -->
                             </div>
                          </div>
                       </div>
                    </div>
                 </li>
                 @endforeach
              @endif
              </ul>
           </div>
        </div>
        <!-- Draggable Without Images card end -->
     </div>
     <!--Completed Ends here-->
  </div>
</div>
<!-- Page-body end -->
        </div>
     </div>
  </div>
</div>
<!-- Main-body end -->
</div>


    <!--Modal for Delete Confirmation-->
    <div class="modal fade" id="delete-Modal" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="project_id" value="0">
                <p></p>
                   <p class="text-center"> <img class="img-fluid" src="{{ asset('resources/assets/files/assets/images/delete.png') }}" alt="Theme-Logo" /></p>
                   <h6 class="text-center">Do you really want to delete this pattern ?</h6>
                   <h6 class="text-center">Action cannot be undone !</h6>
                   <p></p>
            </div>
            <div class="modal-footer">
                    <button class="btn waves-effect waves-light btn-primary theme-outline-btn" data-dismiss="modal">Cancel</button>
                    <button  id="clear-all-tasks" type="button" class="btn btn-danger delete-card" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('footerscript')
<style type="text/css">
  .hide{
    display: none;
  }

</style>
<script type="text/javascript">
  var URL = '{{url("/")}}';
  var DATE = "{{date('d M, Y')}}";
</script>
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/files/assets/pages/notification/notification.css') }}">
   <!-- Animate.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/files/bower_components/animate.css/css/animate.css') }}">
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('resources/assets/files/assets/js/script.js')}}"></script>
<script type="text/javascript" src="{{ asset('resources/assets/files/assets/pages/sortable-custom.js') }}"></script>
<!-- notification js -->
<script type="text/javascript" src="{{ asset('resources/assets/files/assets/js/bootstrap-growl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/assets/files/assets/pages/notification/notification.js') }}"></script>

<script type="text/javascript">
	$(function(){
		$(document).on('click','.moveToArchive',function(){
			var id = $(this).attr('data-id');

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			$.ajax({
				url : '{{url("knitter/project-to-archive")}}',
				type : 'POST',
				data: 'id='+id,
				beforeSend : function(){
					$(".loading").show();
				},
				success : function(res){
					if(res.status == 'success'){
            $("#generatedpatterns"+id+",#workinprogress"+id+",#completed"+id).remove();
						notify('fa fa-check','success',' ','Project has been added to archive');
					}else{
						notify('fa fa-times','error',' ','Unable to add project to archive, Try again after sometime.');
					}
				},
				complete : function(){
					$(".loading").hide();
				}
			});
		});


    $(document).on('click','.deleteAction',function(){
      var id = $(this).attr('data-id');
      $("#project_id").val(id);
    });

    $(document).on('click','.delete-card',function(){
      var id = $("#project_id").val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url : '{{url("knitter/delete-project")}}',
        type : 'POST',
        data: 'id='+id,
        beforeSend : function(){
          $(".loading").show();
        },
        success : function(res){
          if(res.status == 'success'){
            $("#generatedpatterns"+id+",#workinprogress"+id+",#completed"+id).remove();
            notify('fa fa-check','success',' ','Project has been added to archive');
            
          }else{
            notify('fa fa-times','error',' ','Unable to add project to archive, Try again after sometime.');
          }
        },
        complete : function(){
          $(".loading").hide();
        }
      });

    });
	});


	function notify(icon, type,title, msg){
        $.growl({
            icon: icon,
            title: title,
            message: msg,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 999999,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
        });
    };
</script>
@endsection