## 데이터베이스

* 데이터베이스란 정보를 관리하는 전문 애플리케이션
*  파일: 가장 기본적이고 원시적인 형태의 데이터 관리수단
  * 어느 시스템에서든 쓸 수 있음
  * 누구나 사용할 수 있음
* 데이터베이스의 특징
  * 안전하다: 다른 사람이 무단으로 열람하지 못함,컴퓨터에 문제가 생겼을 때 정보를 다른 데 백업하는 시스템
  * 빠르다: index를 통해 정보를 빠르게 찾을 수 있도록 정리를 잘 해둠
  * 프로그래밍적으로 제어 가능: SQL 이용

* 관계형 데이터베이스: 가장 보편화된 데이터베이스 방식 (MySQL, MS-SQL, Oracle...)

* SQL (Structured Query Language) : 컴퓨터에게 구조화된(structured) 정보를 질의(query)하는 프로그래밍 언어(language)
  * 데이터베이스와 엑셀의 차이는 SQL의 유무
* 데이터베이스 동작 방식
  * 클라이언트가 웹서버에 php 웹페이지 요청
  * 웹서버는 PHP 엔진에 php 웹페이지 처리 요청
  * PHP 엔진은 SQL문을 만나면 MySQL 서버에 해당 정보 질의
  * MySQL 서버는 해당 정보를 PHP에 반환, PHP는 웹페이지 처리, 웹서버는 완성된 웹페이지를 웹브라우저에 제공
  * 여기서 PHP는 MySQL 클라이언트라고 할 수 있음 (서버와 클라이언트는 상대적인 관계)

#### MySQL monitor

* MySQL을 제어하는 기본적인 MySQL client
* 명령 프롬프트를 사용해서 실행
  * cd  C:\Bitnami\wampstack-7.3.13-0\mysql\bin
  * mysql -hlocalhost -uroot -p : (MySQL 실행) (-h MySQL 서버주소) (-u 관리자 아이디) (-p 비밀번호 - 생략)

```mysql
# 데이터베이스 목록 보기
show databases;

# 데이터베이스 생성
CREATE DATABASE test CHARACTER SET utf8 COLLATE utf8_general_ci;

# 데이터베이스 선택
use test;
```

```mysql
# 테이블 생성
CREATE TABLE `topic`(
`id` int(11) not null auto_increment, # 값을 넣지 않아도 1씩 증가하며 자동으로 입력
	`title` varchar(100) not null,
	`description` text not null,
	`author` varchar(30) not null,
	`created` datetime not null,
    primary key(id)
) engine = innodb default charset=utf8;

# 테이블 확인
show tables;

# 행 추가
INSERT INTO `topic` (title,description,author,created)
VALUES('about js', 'javascript is ~~~', 'eging', '2015-4-10 12:20:5');

# 데이터 조회
SELECT * FROM topic; # topic의 데이터 전부 조회
SELECT title, author FROM topic # title, author column만 조회
SELECT * FROM topic WHERE id=3; # id=3인 행만 조회
SELECT * FROM topic ORDER bY author DESC; # author를 기준으로 내림차순 정렬하여 조회

# 데이터 기술
desc topic
```

<br>

#### mysqli

* PHP에서 MySQL을 사용하도록 해주는 API

```php
# MySQL 접속
$conn = mysqli_connect('localhost','root','비밀번호');

# 데이터베이스 열기
mysqli_SELECT_db($conn '데이터베이스명');

# 테이블 열기
$result = mysqli_query($conn,'SELECT * from 테이블명');

# 한 행을 연관배열로서 대입
$row = mysqli_fetch_assoc($reslut);
# 일반적인 배열: $a = array('John','16'); echo $a[0];
# 연관배열: $a = array('name'=>'John', 'age'=>'16'); echo $a['name']; 
```

<br>

#### 관계형 데이터베이스 (Relational Database)

* 서로 독립된 테이블을 결합하여 정보를 얻는 데이터베이스 방식

```mysql
SELECT title,name FROM topic LEFT JOIN user ON topic.author=user.id
# topic 테이블을 기준(왼쪽)으로 하여 user 테이블을 결합
# topic의 author와 user의 id를 맞춤
# join하고 맞춘 테이블에서 title과 name만 가져옴
```

* LEFT JOIN : 어느 한 테이블에 값이 존재하지 않는 행은 NULL로 채움
* INNER JOIN : 양 테이블에 모두 값이 존재하는 행만으로 테이블을 만듦 (일반적으로 성능이 더 좋음)
* FULL OUTER JOIN  : LEFT JOIN과 RIGHT JOIN을 행한 후 중복된 행을 지움

```mysql
SELECT * FROM topic FULL OUTER JOIN author ON topic.author_id = author.id

# FULL OUTER JOIN을 지원하지 않는 경우 아래와 같이 쓰면 동일한 결과를 얻음
(SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id) UNION (SELECT * FROM topic RIGHT JOIN author ON topic.author_id = author.id)
```

* EXCLUSIVE JOIN : 한쪽 테이블에 있는 행만 가져옴
