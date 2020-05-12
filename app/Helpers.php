<?php


function selectOld($name, $value) 
{
	return old($name) == $value ? "selected" : '';
}


function stepShow($step, $errors) 
{
		if ($step == 1 && $errors->paso1->any() == true) {
			return "style=display:block";
		}
		else if ($step == 2 && $errors->paso2->any() == true) {
			return "style=display:block";
		}
		else if ($step == 3 && $errors->paso3->any() == true) {
			return "style=display:block";
		}
		else if ($step == 3 && session()->has("status.error.not.file")) {
			return "style=display:block";
		}
		else if ($step == 1 && !$errors->paso1->any() && !$errors->paso2->any() && !$errors->paso3->any()) {
			if (session()->has("card_errors") || session()->has("status.error.not.file")) {
				return "style=display:none";
			}

			return "style=display:block";
		}
		else {
			return "style=display:none";
		}
}

function planSelected($plan) {

	if (old("planSelect") == $plan) {
		return "plan-selected";
	}
}


function planSelectedUpdate($plan, $sale) {
	if (old("planSelect") == $plan) {
		return "plan-selected";
	}
	else {
		if ($sale->plan_id == $plan) {
			return "plan-selected";
		}
	}
}



function planSelectDefault() {
	if (old("planSelect") != 1 && old("planSelect") != 2 && old("planSelect") != 3) {
		return "plan-selected";
	}
}



function homepageReload() {
	if (old("hompage") == true || old("hompage2") == true) {
		return "checked";
	}
}


function hasSession() {
	if (session()->has("card_errors")) {
		return "";
	}

	return "hide";
}


function stepErrorCard($step) {

	if (session()->has("card_errors")) {
		if ($step == 1) {
			return "style=display:none";
		}
		else if ($step == 2) {
			return "style=display:none";
		}
		else if ($step == 3) {
			return "style=display:none";
		}
		else if ($step == 4) {
			return "style=display:block";
		}
	}
}
