 <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Receptores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            @foreach(Receptor::join('coordinators', 'coordinators.id', '=', 'receptors.coordinators_id')->where('coordinators.users_id','=',Auth::user()->id)->select('receptors.mac','receptors.name','receptors.id')->get() as $receptor)
                                <li>
                                    <a href="#"><i class="fa fa-share-alt fa-fw"></i> {{$receptor->name}} <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                    @foreach(Sensor::where('receptors_id','=',$receptor->id)->get() as $sensor)
                                        <li>
                                            <a href="/dashboard/{{$sensor->id}}/sensor"><i class="fa fa-circle fa-fw"></i> {{$sensor->name}}</a>
                                        </li>
                                    @endforeach
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            @endforeach
                            </ul>
                            <!-- /.nav-second-level -->

                        </li>
                         <li>
                             <a href="/logout"><i class="fa fa-times fa-fw"></i> Logout</a>
                         </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
