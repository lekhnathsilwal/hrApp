<style type="text/css">
    .search-div{
        margin-left: -15px;
        background: white;
        width: 300px;
    }
    .search-div h5{
        height: 35px;
        background: white;
        padding: 10px 0 0 10px;
        width: 300px;
        font-weight: bold;
    }
    .search-div li{
        list-style: none;
        height: 35px;
        background: white;
        padding: 10px 0 0 10px;
        width: 300px;
        color: black;
    }
    .search-div li:hover{
        background:#dadce0;
    }
</style>
<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span>
            HrApp
        </span>
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary">HOMER APP</span>
        </div>
        <form class="navbar-form-custom">
            <div class="form-group">
                <input type="text" id="search" onkeyup="setData(this.value)" placeholder="Search something special" class="form-control" name="search" autocomplete="off">
                <div class="search-div" name="search-div" id="search-div"></div>
            </div>
        </form>
        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="{{route('show.admin.details',['id'=>Auth::guard('admin')->user()->id])}}">Profile</a>
                    </li>
                    <li>
                        <a class="" href="{{route('change.password')}}">Change Password</a>
                    </li>
                    <li>
                        <a class="" href="{{route('admin.logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="dropdown">
                    <a href="{{route('admin.logout')}}">
                        <i class="pe-7s-upload pe-rotate-90"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<script>
    function setData(val) {
        if((val.length)>0) {
            var search_div=document.getElementById("search-div")
            search_div.style.display="block";
            var url= '{{ url('search')."/"}}'+val;
            jQuery.ajax({
                url: url, method: 'get',success: function(result){
                    search_div.innerHTML=result;
                }
            });
        }
        if(val.length==0) {
            document.getElementById("search-div").style.display="none";
        }
    }

</script>
