@extends('layout.magazine_main')

@section('title')
    Users List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<style>
    .tab_container { padding: 10px 5px 10px 5px; }
    .tab_container table tr td { font-weight: 600; padding: 8px; }

    .goal { float: left; height: 34px; font-weight: 600; text-align: right; padding: 0 5px 0 5px; }
    .goal_set_value { background-color: #921794;  color: #fff;  width: 100%; }
    .goal_current_value { margin-top: -34px; background-color: #9FC90E; color: #fff; }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Users</a>
            </li>
            <li class="active">
                <strong>List of all Users</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Users List</h5>
                <div class = "pull-right">
                    <select class="form-control" id = "filter" style = "margin-top: -7px;">
                        <option disabled>--select--</option>
                        <option value = "" {{ $filter == "" ? "selected" : "" }}>All</option>
                        <option value = "1" {{ $filter == 1 ? "selected" : "" }}>Admin</option>
                        <option value = "2" {{ $filter == 2 ? "selected" : "" }}>Manager</option>
                        <option value = "3" {{ $filter == 3 ? "selected" : "" }}>Sales Person</option>
                    </select>
                </div>
                <div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Filter by Role:</label></div>
            </div>

            <div class="ibox-content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover UserListdataTables" >
                        <thead>
                        <tr>
                            <th>Sales Name (Last, First and Middle)</th>
                            <th style="width: 150px;">Email</th>
                            <th style="width: 100px;">Role</th>
                            <!-- <th style="width: 150px;">Goal Statistic</th> -->
                            <th style="width: 50px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach ($users as $u)
                                <tr>
                                    <td>{{ $u->last_name .', '. $u->first_name .' '. $u->middle_name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        <?php
                                            if($u->role == 1){
                                                echo "Admin";
                                            }elseif($u->role == 2){
                                                echo "Manager";
                                            }else{
                                                echo "Sales Person";
                                            }
                                        ?>
                                    </td>
                                    <!-- <td class="graph">
                                      <?php
                                        $set_A = 15000;
                                        $set_B = 10000;
                                        $set_C = ($set_B / $set_A) * 100;
                                        $name =  $u->first_name  .' '. $u->last_name;
                                      ?>
                                      <div id="goalStatsSet_{{ $count }}" class="goal goal_set_value"><span class="goal_span">{{ number_format($set_A, 2) }}</span></div>
                                      <div id="goalStatsCur_{{ $count }}" class="goal goal_current_value" data-percent="{{ $set_C }}"><span>{{ $set_B }}</span></div>
                                    </td> -->
                                    <td><button class="btn btn-primary" id="btn_{{ $u->Id }}" onclick="show_settings({{ $u->Id }});" data-sales="{{ $name }}"> <i class="fa fa-cogs" aria-hidden="true"></i> Settings</button></td>
                                </tr>
                                <?php $count++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="user_tab_settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Settings</h4>
            </div>
            <div class="modal-body">
                <h3 id="gaol_sales_name" style="margin: 0 0 30px 0;"></h3>

                <div class="col-lg-12">
                  <div class="tabbable-panel">
                    <div class="tabbable-line">
                      <ul class="nav nav-tabs ">
                        <li >
                          <a href="#tab_default_1" data-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="active">
                          <a href="#tab_default_2" data-toggle="tab">Set Goal</a>
                        </li>
                        <li >
                          <a href="#tab_default_3" data-toggle="tab">Goal Lists</a>
                        </li>
                      </ul>

                      <div class="tab-content">

                        <div class="tab-pane" id="tab_default_1">
                          <div class="tab_container">
                              <h3>It's being updated... </h3>
                          </div>
                        </div>

                        <div class="tab-pane active" id="tab_default_2">
                          <div class="tab_container">

                            <h3>GOAL SETTINGS</h3>
                            <table style="width: 100%;" cellspacing="0" cellpadding="0">
                              <tr>
                                <td> Magazine: </td>
                                <td>
                                  <select class="form-control" id = "ddlPublication" style = "margin-top: -7px;">
                                      <option value = "0">-- All --</option>
                                      @for($o = 0; $o < COUNT($publication); $o++)
                                          <option value = "{{ $publication[$o]->Id }}">{{ $publication[$o]->magazine_name }}</option>
                                      @endfor
                                  </select>
                                </td>
                              </tr>

                              <tr>
                                <td> Issue: </td>
                                <td>
                                  <select class="form-control" id = "ddlIssue" style = "margin-top: -7px;">
                                      <option value = "0">-- All --</option>
                                      @for($o = 1; $o <= 12; $o++)
                                          <option value = "{{ $o }}">{{ $o }}</option>
                                      @endfor
                                  </select>
                                </td>
                              </tr>

                              <tr>
                                <td> Year: </td>
                                <td>
                                  <select class="form-control" id = "ddlYear" style = "margin-top: -7px;">
                                      <option value = "0">-- All --</option>
                                      @for($o = 2014; $o <= date("Y"); $o++)
                                          <option value = "{{ $o }}">{{ $o }}</option>
                                      @endfor
                                  </select>
                                </td>
                              </tr>

                              <tr>
                                <td> Amount: </td>
                                <td><input type="text" class="form-control input-sm" id="txtAmount" placeholder="Amount here..."></td>
                              </tr>

                            </table>
                            <button id="btnAdGoalSettings" class="btn btn-primary pull-right" style="margin-right: 8px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

                          </div>
                        </div>

                        <div class="tab-pane" id="tab_default_3">
                          <div class="tab_container">

                            <h3>GOAL LISTS</h3>
                            <table id="tblGoalSettingsList" style="width: 100%; border:" cellspacing="0" cellpadding="0">
                              <thead>
                                <tr>
                                  <th>Magazine</th>
                                  <th style="width: 180px;">Date Set</th>
                                  <th style="width: 100px;">Issue</th>
                                  <th style="width: 100px;">Year</th>
                                  <th style="width: 100px;">Goal Amount</th>
                                  <th style="width: 100px;">Sale</th>
                                  <th style="width: 100px;">Achievement</th>
                                </th>
                              </thead>
                              <tbody></tbody>
                            </table>

                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
                <div style = "clear: both;"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style = "margin-right: 5px;"><i class="fa fa-ban" aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-2.1.1.js')}}"></script>
<script>
  // setInterval(reload, 2000);
  function reload() {
    $(document).ready( function() {
      $('.graph > .goal_current_value').each(function() {
         var data_per = $(this).data('percent');
         var dp = Math.random() * 100;
         console.log("Percent: " + dp);
         $(this).empty().prepend("<span >"+ numeral(dp).format('0,0.0') +"%</span>");
         $(this).css("width", dp + "%");
      });
    });
  }

  $(document).ready( function() {
    $("#btnAdGoalSettings").click(function() {
      var ddlPublication = $("#ddlPublication").val();
      var ddlIssue = $("#ddlIssue").val();
      var ddlYear = $("#ddlYear").val();
      var txtAmount = $("#txtAmount").val();
      var ddlPublication_parse = parseInt(ddlPublication);
      var ddlIssue_parse = parseInt(ddlIssue);
      var ddlYear_parse = parseInt(ddlYear);
      var txtAmount_parse = parseFloat(txtAmount);

      if(ddlPublication_parse == 0) {
        alert("Please select a publication.");
        return false;
      }

      if(ddlIssue_parse == 0) {
        alert("Please the issue number.");
        return false;
      }

      if(ddlYear_parse == 0) {
        alert("Please the year.");
        return false;
      }
      if(txtAmount_parse == 0) {
        alert("Please enter the rigth amount.");
        return false;
      }

      if(isNaN(txtAmount_parse)) {
        alert("Characters is not allowed.");
        return false;
      }

      var data = { user_id: userIdSelected_, magazine_id: ddlPublication_parse, issue: ddlIssue_parse, year: ddlYear_parse, amount: txtAmount_parse };

      save_goal(data);

    })
  })

  function get_goal_lists(data) {
    $(document).ready(function() {
        $.ajax({
            dataType: 'json',
            type:'GET',
            data: data,
            url: '/users/goal/lists'
        }).done(function(json){
          var html = "";
          var count = 0;
          caches_for_achived = [];
          $(json.Data).each(function(a,b) {
            html+="<tr>";
            html+="<td>"+b.magazine_name+"</td>";
            html+="<td>"+b.created_at+"</td>";
            html+="<td>"+b.issue+"</td>";
            html+="<td>"+b.year+"</td>";
            html+="<td>"+numeral(b.amount).format('0,0.00')+"</td>";
            html+="<td><span id='achives_"+count+"'></span></td>";
            html+="<td><div id='achives_A"+count+"_percent' class='goal goal_set_value'><span class='goal_span'></span></div>";
            html+="<div id='achives_B"+count+"_percent' class='goal goal_current_value'><span>2</span></div></td>";
            html+="</tr>";
            var c_data = [b.magazine_id, b.issue, b.year, userIdSelected_, b.amount];
            caches_for_achived.push(c_data);
            count++;
          })
          $("#tblGoalSettingsList > tbody").empty().prepend(html);
          for(var i = 0; i < caches_for_achived.length; i++) {
            var url = "http://" + report_url_api + "/kpa/work/goal/report";
            url += "/" + caches_for_achived[i][0];
            url += "/" + caches_for_achived[i][1];
            url += "/" + caches_for_achived[i][2];
            url += "/" + caches_for_achived[i][3];
            console.log(url);
            var amount = caches_for_achived[i][4];
            get_achives_amount(url, amount, i);
          }
        });
    })
  }

  function get_achives_amount(url, amount, id) {
    $(document).ready(function() {
        $.ajax({
            dataType: 'json',
            type:'GET',
            url: url,
            beforeSend: function () {
              $("#achives_"+id).text("***");
            },
        }).done(function(json){
          $("#achives_"+id).text(numeral(json.Total_Amount).format('0,0.00'));
          var get_percent = 0;
          if(parseFloat(json.Total_Amount) >= parseFloat(amount)) {
            $("#achives_B"+id+"_percent").empty().text(numeral(100).format('0,0.00') + "%");
            $("#achives_B"+id+"_percent").attr("style", "width: 100%;");
          }
          else {
            get_percent = parseFloat(json.Total_Amount) / parseFloat(amount);
            get_percent = get_percent * 100;
            $("#achives_B"+id+"_percent").empty().text(numeral(get_percent).format('0,0.00') + "%");
            $("#achives_B"+id+"_percent").attr("style", "width: "+get_percent+"%;");
            if(get_percent == 0) {
              $("#achives_A"+id+"_percent").empty().text(numeral(get_percent).format('0,0.00') + "%");
              $("#achives_B"+id+"_percent").hide();
            }
          }
        });
    })
  }

  function save_goal(data) {
    $(document).ready(function() {
        $.ajax({
            dataType: 'json',
            type:'GET',
            data: data,
            url: '/users/goal/settings'
        }).done(function(json){
          if(json.Status == 200) {
            alert("Goal Settings was saved.");
            location.reload();
            return false;
          }
          alert("Something went wrong, Please try again.");
        });
    })
  }

</script>

@endsection
@section('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready( function() {
        $("#filter").on('change', function(){
            window.location.href = "/users/all/" + $(this).val();
        });
        $('.UserListdataTables').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
        });

        // var users_count = {{ COUNT($users) }};
        // for(var i = 0; i < users_count; i++) {
        //
        //   var rand_intA = get_dummy_number(600);
        //
        //   var rand_intB = get_dummy_number(500);
        //
        //   var rand_valC = get_times(rand_intB, rand_intA);
        //
        //   $("#goalStatsSet_" + i).empty().prepend("<span >"+ rand_intA +"</span>");
        //
        //   $("#goalStatsCur_" + i).empty().prepend("<span >"+ rand_intB +"</span>");
        //
        //   // console.log(rand_intA);
        //   //
        //   // console.log(rand_intB);
        //
        //   console.log(rand_valC);
        //
        //   $("#goalStatsCur_" + i).attr("style", "width: " + rand_valC + "%;");
        //
        // }

    });

    function get_dummy_number(value) {
      var rand_ = Math.random() * 100;
      return Math.round(rand_ * value);
    }

    function get_times(a, b) {
      var x = b / a;
      return x * 100;
    }

</script>
@endsection
