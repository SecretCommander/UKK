<!DOCTYPE html>
<?php 
header('Location: login.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Memorize | Home</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Default"
      disabled
      href="/css/app-937c1ff7d52fd6f78dd9322599e2b5d4.css?vsn=d"
    />
    <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Web Awesome"
      href="/css/app-wa-8d95b745961f6b33ab3aa1b98a45291a.css?vsn=d"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css"
    />

    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css"
    />
    <link rel="stylesheet" href="../admin_dashboard/plugins/fontawesome-free/css/all.min.css" />
    <!-- fullCalendar -->
    <link rel="stylesheet" href="../admin_dashboard/plugins/fullcalendar/main.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin_dashboard/dist/css/adminlte.min.css" />
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="navbar-search"
              href="#"
              role="button"
            >
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input
                    class="form-control form-control-navbar"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button
                      class="btn btn-navbar"
                      type="button"
                      data-widget="navbar-search"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="control-sidebar"
              data-slide="true"
              href="#"
              role="button"
            >
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-green elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
          <img
            src="dist/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8;"
          />
          <span class="brand-text font-weight-light">AdminTara</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="dist/img/user2-160x160.jpg"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="#" class="d-block">Shinichi</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="index.php" class="nav-link active">
                  <i class="nav-icon fa-regular fa-house"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-database"></i>
                  <p>
                    User Database
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a
                      href="../admin_dashboard/halaman/database/user-datalist.php"
                      class="nav-link"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>User Datalist</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../admin_dashboard/halaman/database/seller-datalist.php"
                      class="nav-link"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>Seller Datalist</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      href="../admin_dashboard/halaman/database/admin-datalist.php"
                      class="nav-link"
                    >
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Datalist</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                </ol>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="card card-success card-outline">
                  <div class="card-header">
                    <h5 class="m-0">Selamat Datang Shinichi di AdminTara</h5>
                  </div>
                  <div class="card-body">
                    <h6 class="card-title">Mengatur Database User dan Seller</h6>

                    <p class="card-text">
                      <!-- With supporting text below as a natural lead-in to
                      additional content. -->
                    </p>
                    <a href="../admin_dashboard/halaman/database/user-datalist.php" class="btn btn-success">User DB</a>
                    <a href="../admin_dashboard/halaman/database/seller-datalist.php" class="btn btn-success">Seller DB</a>
                  </div>
                  <hr />
                  <div class="card-body">
                    <h6 class="card-title">Mengatur Database Admin</h6>

                    <p class="card-text">
                      <!-- With supporting text below as a natural lead-in to
                      additional content. -->
                    </p>
                    <a href="../admin_dashboard/halaman/database/admin-datalist.php" class="btn btn-success">Go</a>
                  </div>
                  <hr />
                  <div class="card-body">
                    <h6 class="card-title">Mengatur Banner Iklan</h6>

                    <p class="card-text">
                      <!-- With supporting text below as a natural lead-in to
                      additional content. -->
                    </p>
                    <a href="../admin_dashboard/halaman/database/ads-banner.html" class="btn btn-success">Go</a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Draggable Events</h4>
                  </div>
                  <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">
                      <div class="external-event bg-success">Lunch</div>
                      <div class="external-event bg-warning">Go home</div>
                      <div class="external-event bg-info">Do homework</div>
                      <div class="external-event bg-primary">
                        Work on UI design
                      </div>
                      <div class="external-event bg-danger">Sleep tight</div>
                      <div class="checkbox">
                        <label for="drop-remove">
                          <input type="checkbox" id="drop-remove" />
                          remove after drop
                        </label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Create Event</h3>
                  </div>
                  <div class="card-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                      <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                      </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                      <input id="new-event" type="text" class="form-control" placeholder="Event Title">
  
                      <div class="input-group-append">
                        <button id="add-new-event" type="button" class="btn btn-success">Add</button>
                      </div>
                      <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                  </div>
                </div>
              </div>
              <!-- /.col-md-6 -->
              <div class="col-md-9">
                <div class="card card-primary">
                  <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          <!-- Anything you want -->
        </div>
        <!-- Default to the left -->
        AdminTara
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../admin_dashboard/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../admin_dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <script src="../admin_dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../admin_dashboard/dist/js/adminlte.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="../admin_dashboard/plugins/moment/moment.min.js"></script>
    <script src="../admin_dashboard/plugins/fullcalendar/main.js"></script>
    <script>
      $(function () {
        /* initialize the external events
 -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {
            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()), // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data("eventObject", eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0, //  original position after the drag
            });
          });
        }

        ini_events($("#external-events div.external-event"));

        /* initialize the calendar
 -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
          m = date.getMonth(),
          y = date.getFullYear();

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById("external-events");
        var checkbox = document.getElementById("drop-remove");
        var calendarEl = document.getElementById("calendar");

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
          itemSelector: ".external-event",
          eventData: function (eventEl) {
            return {
              title: eventEl.innerText,
              backgroundColor: window
                .getComputedStyle(eventEl, null)
                .getPropertyValue("background-color"),
              borderColor: window
                .getComputedStyle(eventEl, null)
                .getPropertyValue("background-color"),
              textColor: window
                .getComputedStyle(eventEl, null)
                .getPropertyValue("color"),
            };
          },
        });

        var calendar = new Calendar(calendarEl, {
          headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
          },
          themeSystem: "bootstrap",
          //Random default events
          // events: [
          //   {
          //     title          : 'All Day Event',
          //     start          : new Date(y, m, 1),
          //     backgroundColor: '#f56954', //red
          //     borderColor    : '#f56954', //red
          //     allDay         : true
          //   },
          //   {
          //     title          : 'Long Event',
          //     start          : new Date(y, m, d - 5),
          //     end            : new Date(y, m, d - 2),
          //     backgroundColor: '#f39c12', //yellow
          //     borderColor    : '#f39c12' //yellow
          //   },
          //   {
          //     title          : 'Meeting',
          //     start          : new Date(y, m, d, 10, 30),
          //     allDay         : false,
          //     backgroundColor: '#0073b7', //Blue
          //     borderColor    : '#0073b7' //Blue
          //   },
          //   {
          //     title          : 'Lunch',
          //     start          : new Date(y, m, d, 12, 0),
          //     end            : new Date(y, m, d, 14, 0),
          //     allDay         : false,
          //     backgroundColor: '#00c0ef', //Info (aqua)
          //     borderColor    : '#00c0ef' //Info (aqua)
          //   },
          //   {
          //     title          : 'Birthday Party',
          //     start          : new Date(y, m, d + 1, 19, 0),
          //     end            : new Date(y, m, d + 1, 22, 30),
          //     allDay         : false,
          //     backgroundColor: '#00a65a', //Success (green)
          //     borderColor    : '#00a65a' //Success (green)
          //   },
          //   {
          //     title          : 'Click for Google',
          //     start          : new Date(y, m, 28),
          //     end            : new Date(y, m, 29),
          //     url            : 'https://www.google.com/',
          //     backgroundColor: '#3c8dbc', //Primary (light-blue)
          //     borderColor    : '#3c8dbc' //Primary (light-blue)
          //   }
          // ],
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
              // if so, remove the element from the "Draggable Events" list
              info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
          },
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        // Color chooser button
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          // Save color
          currColor = $(this).css("color");
          // Add color effect to button
          $("#add-new-event").css({
            "background-color": currColor,
            "border-color": currColor,
          });
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          // Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          // Create events
          var event = $("<div />");
          event
            .css({
              "background-color": currColor,
              "border-color": currColor,
              color: "#fff",
            })
            .addClass("external-event");
          event.text(val);
          $("#external-events").prepend(event);

          // Add draggable funtionality
          ini_events(event);

          // Remove event from text input
          $("#new-event").val("");
        });
      });
    </script>
  </body>
</html>