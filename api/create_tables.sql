create database ecommerce;
use ecommerce;

create table products(
	product_id int(10) primary key auto_increment,
    product_title varchar(255) not null,
	product_brand int(10) not null,
    product_cat int(10) not null,
    prodcut_price double(10, 2) not null,
    product_image varchar(255) not null,
    product_keywords varchar(255) not null,
    product_desc varchar(255) not null
)ENGINE=innoDB;

create table categories(
	cat_id int(10) primary key auto_increment,
    cat_title varchar(255) not null
)ENGINE=innoDB;

create table brands(
	brand_id int(10) primary key auto_increment, 
    brand_title varchar(255) not null
)ENGINE=innoDB;


create table admin(
	admin_id int(10) primary key auto_increment, 
    admin_name varchar(255) not null,
    admin_email varchar(255) not null,
	admin_password varchar(255) not null
)ENGINE=innoDB;


create table customers(
	customer_id int(10) primary key auto_increment,
    customer_name varchar(255) not null,
    customer_email varchar(255) not null,
    customer_password varchar(255) not null
)ENGINE=innoDB;

