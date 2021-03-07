<!DOCTYPE html>
<html>

<head>
    <title>Calculator</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=<?= base_url('css/cal.css') ?> >
    <link rel="stylesheet" href=<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?> >

    <script src= <?= base_url('js/cal.js') ?> ></script>
    <script src= <?= base_url('assets/bootstrap/js/bootstrap.min.js') ?> ></script>
</head>

<body>
    <!--标准型-->
    <div class="rounded standard-main" id="std-main">
        <div class="title ml-3">
            Calculator
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
            <li value="17">%</li>
            <li value="18">√</li>
            <li value="19"><img src= <?= base_url("assets/images/x_2.png") ?> style="height: 18px;" /></li>
            <li value="20"><img src= <?= base_url("assets/images/1_x.png") ?> /></li>
        </ul>
        <!--数字和符号-->
        <ul class="rounded" id="std-num-symbol">
            <li value="37"><button class="btn btn-lg btn-primary">CE</button></li>
            <li value="38">C</li>
            <li value="39">Back</li>
            <li value="16">÷</li>
            <li class="number" value="7">7</li>
            <li class="number" value="8">8</li>
            <li class="number" value="9">9</li>
            <li value="15">×</li>
            <li class="number" value="4">4</li>
            <li class="number" value="5">5</li>
            <li class="number" value="6">6</li>
            <li value="14">-</li>
            <li class="number" value="1">1</li>
            <li class="number" value="2">2</li>
            <li class="number" value="3">3</li>
            <li value="13">+</li>
            <li value="11">±</li>
            <li class="number" value="0">0</li>
            <li value="10">.</li>
            <li value="12">=</li>
        </ul>
        <!--侧边栏，选择计算器类型-->
        <ul class="type-bar" id="std-type-bar">
            <li class="active">Standard</li>
            <li value="2">Science</li>
            <li value="3">Programmer</li>
        </ul>
    </div>
    <!--科学型-->
    <div class="rounded science-main" id="sci-main">
        <div class="title ml-3">
            Calculator
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
            <li value="21">(</li>
            <li value="22">)</li>
            <li value="23"><img src= <?= base_url("assets/images/x_y_sqrt.png") ?> style="height: 18px;width: 22px;" /></li>
            <li value="24">n!</li>
            <li value="25">Exp</li>
            <li value="19"><img src= <?= base_url("assets/images/x_2.png") ?> style="height: 18px;" /></li>
            <li value="26"><img src= <?= base_url("assets/images/x_y.png") ?> style="height: 18px;" /></li>
            <li value="27">sin</li>
            <li value="28">cos</li>
            <li value="29">tan</li>
            <li value="30"><img src= <?= base_url("assets/images/10_x.png") ?> /></li>
            <li value="31">log</li>
            <li value="32">sinh</li>
            <li value="33">cosh</li>
            <li value="34">tanh</li>
        </ul>
        <!--数字和符号-->
        <ul class="rounded list-inline" id="sci-num-symbol">
            <li value="35">π</li>
            <li value="37">CE</li>
            <li value="38">C</li>
            <li value="39">Back</li>
            <li value="16">÷</li>
            <li value="18">√</li>
            <li value="7" class="number">7</li>
            <li value="8" class="number">8</li>
            <li value="9" class="number">9</li>
            <li value="15">×</li>
            <li value="17">%</li>
            <li value="4" class="number">4</li>
            <li value="5" class="number">5</li>
            <li value="6" class="number">6</li>
            <li value="14">-</li>
            <li value="20"><img src= <?= base_url("assets/images/1_x.png") ?> /></li>
            <li value="1" class="number">1</li>
            <li value="2" class="number">2</li>
            <li value="3" class="list-inline-itemnumber">3</li>
            <li value="13">+</li>
            <li value="36">↑</li>
            <li value="11">±</li>
            <li value="0" class="number">0</li>
            <li value="10">.</li>
            <li value="12">=</li>
        </ul>
        <!--侧边栏，选择计算器类型-->
        <ul class="type-bar" id="sci-type-bar">
            <li value="1">Standard</li>
            <li class="active">Science</li>
            <li value="3">Programmer</li>
        </ul>
    </div>
    <!--程序员型-->
    <div class="rounded programmer-main" id="pro-main">
        <div class="title ml-3">
            Calculator
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
            <li class="disable-btn" value="40">A</li>
            <li class="disable-btn" value="41">B</li>
            <li class="disable-btn" value="42">C</li>
            <li class="disable-btn" value="43">D</li>
            <li class="disable-btn" value="44">E</li>
            <li class="disable-btn" value="45">F</li>
        </ul>
        <!--数字和符号-->
        <ul class="rounded" id="pro-num-symbol">
            <li value="36">↑</li>
            <li value="37">CE</li>
            <li value="38">C</li>
            <li value="39">Back</li>
            <li value="16">÷</li>
            <li value="46">And</li>
            <li value="7" class="number" bin-disable="1">7</li>
            <li value="8" class="number" oct-disable="1" bin-disable="1">8</li>
            <li value="9" class="number" oct-disable="1" bin-disable="1">9</li>
            <li value="15">×</li>
            <li value="47">Or</li>
            <li value="4" class="number" bin-disable="1">4</li>
            <li value="5" class="number" bin-disable="1">5</li>
            <li value="6" class="number" bin-disable="1">6</li>
            <li value="14">-</li>
            <li value="48">Not</li>
            <li value="1" class="number">1</li>
            <li value="2" class="number" bin-disable="1">2</li>
            <li value="3" class="number" bin-disable="1">3</li>
            <li value="13">+</li>
            <li value="21">(</li>
            <li value="22">)</li>
            <li value="0" class="number">0</li>
            <li value="10" class="disable-btn" id="pro-point">.</li>
            <li value="12">=</li>
        </ul>
        <!--侧边栏，选择计算器类型-->
        <ul class="type-bar" id="pro-type-bar">
            <li value="1">Standard</li>
            <li value="2">Science</li>
            <li class="active">Programmer</li>
        </ul>
    </div>
</body>

</html>