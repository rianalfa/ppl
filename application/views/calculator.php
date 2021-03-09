<!DOCTYPE html>
<html>

<?php $this->load->view('_partials/head'); ?>

<body>
    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div id="content">
                <div class="container-fluid p-0 px-lg-0 px-md-0">

                    <!-- Navbar -->
                    <?php $this->load->view('_partials/navbar'); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <div class="col-md-12 mt-4">
                                    <!--标准型-->
                                    <div class="rounded standard-main" id="std-main">
                                        <div class="title ml-3">
                                        Kalkulator
                                        </div>
                                        <!--结果显示区域-->
                                        <div class="result ml-3">
                                            <!--显示类型信息-->
                                            <div class="type" id="std-show-bar">
                                                ☰&nbsp;&nbsp;&nbsp;Standard
                                            </div>
                                            <!--第二个/运算结果-->
                                            <div class="second mr-3" id="std-show-input">0</div>
                                        </div>
                                        <ul id="std-top-symbol">
                                            <li style="float: left; text-align: center; cursor: pointer;" value="17">%</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="18">√</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="19"><img src= <?= base_url("assets/images/x_2.png") ?> style="height: 18px;" /></li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="20"><img src= <?= base_url("assets/images/1_x.png") ?> /></li>
                                        </ul>
                                        <!--数字和符号-->
                                        <ul class="rounded" style="float: left; text-align: center; cursor: pointer;" id="std-num-symbol">
                                            <li style="float: left; text-align: center; cursor: pointer;" value="37">CE</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="38">C</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="39">Back</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="16">÷</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="7">7</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="8">8</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="9">9</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="15">×</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="4">4</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="5">5</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="6">6</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="14">-</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="1">1</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="2">2</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="3">3</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="13">+</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="11">±</li>
                                            <li class="number" style="float: left; text-align: center; cursor: pointer; font-weight: bold;" value="0">0</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="10">.</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="12">=</li>
                                        </ul>
                                        <!--侧边栏，选择计算器类型-->
                                        <ul class="type-bar" id="std-type-bar">
                                            <li class="active" style="float: left; text-align: center; cursor: pointer;">Standard</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="2">Science</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="3">Programmer</li>
                                        </ul>
                                    </div>
                                    <!--科学型-->
                                    <div class="rounded science-main" id="sci-main">
                                        <div class="title ml-3">
                                        Kalkulator
                                        </div>
                                        <!--结果显示区域-->
                                        <div class="sci-result ml-3">
                                            <!--显示类型信息-->
                                            <div class="type" id="sci-show-bar">
                                                ☰&nbsp;&nbsp;&nbsp;Science
                                            </div>
                                            <!--第二个/运算结果-->
                                            <div class="second mr-3" id="sci-show-input">0</div>
                                        </div>
                                        <!--上面的3行运算符-->
                                        <ul id="sci-top-symbol">
                                            <li style="float: left; text-align: center;" value="21">(</li>
                                            <li style="float: left; text-align: center;" value="22">)</li>
                                            <li style="float: left; text-align: center;" value="23"><img src= <?= base_url("assets/images/x_y_sqrt.png") ?> style="height: 18px;width: 22px;" /></li>
                                            <li style="float: left; text-align: center;" value="24">n!</li>
                                            <li style="float: left; text-align: center;" value="25">Exp</li>
                                            <li style="float: left; text-align: center;" value="19"><img src= <?= base_url("assets/images/x_2.png") ?> style="height: 18px;" /></li>
                                            <li style="float: left; text-align: center;" value="26"><img src= <?= base_url("assets/images/x_y.png") ?> style="height: 18px;" /></li>
                                            <li style="float: left; text-align: center;" value="27">sin</li>
                                            <li style="float: left; text-align: center;" value="28">cos</li>
                                            <li style="float: left; text-align: center;" value="29">tan</li>
                                            <li style="float: left; text-align: center;" value="30"><img src= <?= base_url("assets/images/10_x.png") ?> /></li>
                                            <li style="float: left; text-align: center;" value="31">log</li>
                                            <li style="float: left; text-align: center;" value="32">sinh</li>
                                            <li style="float: left; text-align: center;" value="33">cosh</li>
                                            <li style="float: left; text-align: center;" value="34">tanh</li>
                                        </ul>
                                        <!--数字和符号-->
                                        <ul class="rounded list-inline" id="sci-num-symbol">
                                            <li style="float: left; text-align: center;" value="35">π</li>
                                            <li style="float: left; text-align: center;" value="37">CE</li>
                                            <li style="float: left; text-align: center;" value="38">C</li>
                                            <li style="float: left; text-align: center;" value="39">Back</li>
                                            <li style="float: left; text-align: center;" value="16">÷</li>
                                            <li style="float: left; text-align: center;" value="18">√</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="7" class="number">7</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="8" class="number">8</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="9" class="number">9</li>
                                            <li style="float: left; text-align: center; " value="15">×</li>
                                            <li style="float: left; text-align: center;" value="17">%</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="4" class="number">4</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="5" class="number">5</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="6" class="number">6</li>
                                            <li style="float: left; text-align: center;" value="14">-</li>
                                            <li style="float: left; text-align: center;" value="20"><img src= <?= base_url("assets/images/1_x.png") ?> /></li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="1" class="number">1</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="2" class="number">2</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="3" class="list-inline-itemnumber">3</li>
                                            <li style="float: left; text-align: center;" value="13">+</li>
                                            <li style="float: left; text-align: center;" value="36">↑</li>
                                            <li style="float: left; text-align: center;" value="11">±</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="0" class="number">0</li>
                                            <li style="float: left; text-align: center;" value="10">.</li>
                                            <li style="float: left; text-align: center;" value="12">=</li>
                                        </ul>
                                        <!--侧边栏，选择计算器类型-->
                                        <ul class="type-bar" id="sci-type-bar">
                                            <li style="float: left; text-align: center; cursor: pointer;" value="1">Standard</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" class="active">Science</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="3">Programmer</li>
                                        </ul>
                                    </div>
                                    <!--程序员型-->
                                    <div class="rounded programmer-main" id="pro-main">
                                        <div class="title ml-3">
                                        Kalkulator
                                        </div>
                                        <!--结果显示区域-->
                                        <div class="pro-result ml-3">
                                            <!--显示类型信息-->
                                            <div class="type" id="pro-show-bar">
                                                ☰&nbsp;&nbsp;&nbsp;Programmer
                                            </div>
                                            <!--第二个/运算结果-->
                                            <div class="second mr-3" id="pro-show-input">0</div>
                                            <!--显示16、10、8、2进制的值-->
                                            <div id="pro-scales">
                                                <div scale="16">HEX&nbsp;&nbsp;&nbsp;<span>0</span></div>
                                                <div scale="10" class="scale-active">DEC&nbsp;&nbsp;&nbsp;<span>0</span></div>
                                                <div scale="8">OCT&nbsp;&nbsp;&nbsp;<span>0</span></div>
                                                <div scale="2">BIN&nbsp;&nbsp;&nbsp;&nbsp;<span>0</span></div>
                                            </div>
                                        </div>
                                        <!--上面的一行十六进制数字，因为默认是10进制，所以这些按钮默认禁用-->
                                        <ul id="pro-top-symbol">
                                            <li class="disable-btn" style="float: left; text-align: center;" value="40">A</li>
                                            <li class="disable-btn" style="float: left; text-align: center;" value="41">B</li>
                                            <li class="disable-btn" style="float: left; text-align: center;" value="42">C</li>
                                            <li class="disable-btn" style="float: left; text-align: center;" value="43">D</li>
                                            <li class="disable-btn" style="float: left; text-align: center;" value="44">E</li>
                                            <li class="disable-btn" style="float: left; text-align: center;" value="45">F</li>
                                        </ul>
                                        <!--数字和符号-->
                                        <ul class="rounded" id="pro-num-symbol">
                                            <li style="float: left; text-align: center;" value="36">↑</li>
                                            <li style="float: left; text-align: center;" value="37">CE</li>
                                            <li style="float: left; text-align: center;" value="38">C</li>
                                            <li style="float: left; text-align: center;" value="39">Back</li>
                                            <li style="float: left; text-align: center;" value="16">÷</li>
                                            <li style="float: left; text-align: center;" value="46">And</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="7" class="number" bin-disable="1">7</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="8" class="number" oct-disable="1" bin-disable="1">8</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="9" class="number" oct-disable="1" bin-disable="1">9</li>
                                            <li style="float: left; text-align: center;" value="15">×</li>
                                            <li style="float: left; text-align: center;" value="47">Or</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="4" class="number" bin-disable="1">4</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="5" class="number" bin-disable="1">5</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="6" class="number" bin-disable="1">6</li>
                                            <li style="float: left; text-align: center;" value="14">-</li>
                                            <li style="float: left; text-align: center;" value="48">Not</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="1" class="number">1</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="2" class="number" bin-disable="1">2</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="3" class="number" bin-disable="1">3</li>
                                            <li style="float: left; text-align: center;" value="13">+</li>
                                            <li style="float: left; text-align: center;" value="21">(</li>
                                            <li style="float: left; text-align: center;" value="22">)</li>
                                            <li style="float: left; text-align: center; font-weight: bold;" value="0" class="number">0</li>
                                            <li style="float: left; text-align: center;" value="10" class="disable-btn" id="pro-point">.</li>
                                            <li style="float: left; text-align: center;" value="12">=</li>
                                        </ul>
                                        <!--侧边栏，选择计算器类型-->
                                        <ul class="type-bar" id="pro-type-bar">
                                            <li style="float: left; text-align: center; cursor: pointer;" value="1">Standard</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" value="2">Science</li>
                                            <li style="float: left; text-align: center; cursor: pointer;" class="active">Programmer</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });
    </script>
</body>

</html>