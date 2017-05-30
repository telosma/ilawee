<div id="content-layouts-wrapper">
    <div id="content-layouts">
        <!-- content -->
        <div id="content">
            @include('includes.menuLeft')
            <!-- cột phải 790 zone1-->
            <div class="right-790">
                <!-- Cột giữa -->
                <div class="left-580">
                    <div class="ms-webpart-zone ms-fullWidth">
                        <!-- ô tìm kiếm -->
                        @include('includes.boxSearch')
                        <!-- ô tìm kiếm -->
                        <div class="home-content">
                            @include('includes.content.home')
                        </div>
                    </div>
                </div>
                <!-- cột phải -->
                @include('includes.menuRight')
                <!-- cột phải -->
            </div>
            <!-- cột phải 790 zone1-->
        </div>
        <!-- content -->
    </div>
</div>
