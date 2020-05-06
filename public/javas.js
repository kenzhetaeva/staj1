const x_i = document.querySelector(".x_icon");
const agree = document.querySelector(".knopka");
const set_fon = document.querySelector(".setting_fon");
const set_menu = document.querySelector(".setting_menu");
const setting = document.querySelector(".setting");
const section1 = document.querySelector(".section_1");
const section2 = document.querySelector(".section_2");
const section3 = document.querySelector(".section_3");
const section4 = document.querySelector(".section_4");
const section5 = document.querySelector(".section_5");
const shapka = document.querySelector(".shapka");
const menu_fon = document.querySelector(".menu");
const menu_icon = document.querySelector("#menu_icon");
const menu_links = document.querySelector(".menu_links");
const ramka = document.querySelector(".ramka");
const footer = document.querySelector(".footer");

set_menu.onclick = function() {
	set_fon.style.transform = "translateX(0%)";
	setting.style.transform = "translateX(0%)";
	x_i.style.transform = "translateX(0%)";
	agree.style.transform = "translateX(0%) rotateZ(0deg)";
}

x_i.onclick = function() {
	set_fon.style.transform = "translateX(-110%)";
	setting.style.transform = "translateX(-120%)";
	x_i.style.transform = "translateX(-1500%) rotateZ(-1600deg)";
	agree.style.transform = "translateX(-500%)";
}

agree.onclick = function() {
	var velues = document.querySelectorAll(".setting_values");
	var val = new Array();

	for(let i = 0; i < 5; i++) {
		val.push(velues[i].value);
	}

	section1.style.background = val[0];
	section2.style.background = val[0];
	section3.style.background = val[0];
	section4.style.background = val[0];
	section5.style.background = val[0];
	shapka.style.background = val[0];
	menu_fon.style.background = val[0];
	menu_icon.style.background = val[1];
	menu_links.style.background = val[1];
	ramka.style.background = val[2];
	footer.style.background = val[3];
	footer.style.color = val[4];

	for(let i = 0; i < 5; i++) {
		val.pop();
	}
}