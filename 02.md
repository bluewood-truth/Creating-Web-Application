## 프로그래밍 예습

#### PHP

1. 웹브라우저가 http://a.com/a.php 주소를 요청
2. 웹서버가 .php를 인식하여 PHP인터프리터(PHP엔진)에게 a.php 파일을 처리하라고 명령
3. PHP인터프리터는 하드에 저장된 a.php 파일을 읽어서 해석
4. php 파일에 포함된 php 문법을 해석하여 데이터베이스에서 데이터를 가져와 html 파일로 완성

* CSS가 HTML에서 분리되어 디자인을 담당했듯이, PHP는 하나의 HTML로 여러 정보들을 표현할 수 있음
* php.ini 설정: display_errors=On, opcache.enable=0

#### JavaScript vs PHP

* HTML, CSS는 정적인 언어: 한번 화면에 띄우면 바뀌지 않음 (문서 작성 목적)
* JavaScript, PHP는 동적인 언어: 사용자의 클릭이나 입력에 따라 동작이 달라짐
* JavaScript 코드는 웹브라우저가 HTML 코드로서 해석함, 하지만 PHP 코드는 PHP인터프리터가 처리한 내용을 웹서버에 전달하여 웹브라우저에 표시되기 때문에 웹브라우저에서는 PHP 코드를 볼 수 없음 (서버에서 돌아가는 코드)

#### 시작하기에 앞서

* wampstack/php/php.ini
  * display_errors = On : 에러로그 표시
  * opcache.enable = 0 : 변경사항 실시간 반영
  * (실제 서비스 시에는 보안상, 성능상 기본 설정으로 돌려놓는 게 좋다)

<br>

## 프로그래밍(JavaScript, PHP)

#### 연산자

* JavaScript: 숫자든 문자든 더할때 +를 사용
* PHP: 숫자를 더할땐 +, 문자를 더할땐 .을 사용 ("10" + "10"은 숫자로 바꿔서 계산됨)

#### 디버그

* JavaScript: 크롬 개발자도구-Console에서 에러로그 확인
* PHP: apache2/logs/error.log 확인

#### 변수

* PHP에서 변수선언하고 사용할때는 변수명 앞에 $를 붙인다.
  * $name = "John";
  * echo $name;

#### 비교

* PHP에서는 true/false를 표시할 때 var_dump() 함수를 사용

#### \<form>으로 submit했을 때

*  $_GET["(name)"]: 이전 페이지에서 submit한 값을 받을 때 사용

#### 배열

``` javasc
// js
list = new Array("one", "two", "three");
document.write(list[2]);
document.write(list.length);
```

``` php
// php
$list = array("one", "two", "three");
echo $list[2];
echo count($list);
```

#### 함수

```javascript
// js
function sum(a,b){
    return a + b;
}
document.write("<p>"+sum(1,2)+"</p>")
```

``` PHP
// php
function sum($a, $b){
    return $a + $b;
}
echo "<p>".sum(1,2)."</p>"
```

### UI vs API

* UI(User Interface)
* API(Application Programming Interface)

#### Interface

* 장치와 장치, 장치와 사람, 웹 애플리케이션과 웹 브라우저 등의 사이에서 교류할 수 있는 접점
* UI: 사용자가 직접 조작하는 인터페이스
* API: 애플리케이션이 어떤 동작을 하기 위해 프로그래밍적으로 그 애플리케이션이 돌아가는 시템에게 전달하는 명령
  * 예를 들어 js에서 prompt 함수를 사용하면, 웹브라우저에서는 그 명령을 받아 미리 준비된 프롬프트 창을 띄움
