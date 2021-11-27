const userPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
const userPrefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;

function darkmode_init()
{
    // Button id
	let darkmodeSwitch = document.querySelector('#darkmodebtn');

    // Stuff that needs change
    let bodysite = document.body;
    let searchbtn = document.querySelector('#top-search');
	
	let darkmodeCookie = {
		set:function(key,value,time,path,secure=false)
		{
			let expires = new Date();
			expires.setTime(expires.getTime() + time);
			var path   = (typeof path !== 'undefined') ? pathValue = 'path=' + path + ';' : '';
			var secure = (secure) ? ';secure' : '';
			
			document.cookie = key + '=' + value + ';' + path + 'expires=' + expires.toUTCString() + secure;
		},
		get:function()
		{
			let keyValue = document.cookie.match('(^|;) ?darkmode=([^;]*)(;|$)');
			return keyValue ? keyValue[2] : null;
		},
		remove:function()
		{
			document.cookie = 'darkmode=; Max-Age=0; path=/';
		}
	};
	
	
	if(darkmodeCookie.get() == 'true')
	{
		darkmodeSwitch.classList.add('active');
        // add here the changes
		bodysite.classList.add('darkmode');
        searchbtn.classList.add('darkmode');

	}
	
	
	darkmodeSwitch.addEventListener('click', (event) => {
		event.preventDefault();
		event.target.classList.toggle('active');
        // add here the changes
		bodysite.classList.toggle('darkmode');
        searchbtn.classList.toggle('darkmode');
		
		if(document.body.classList.contains('darkmode') || userPrefersDark)
		{
			darkmodeCookie.set('darkmode','true',2628000000,'/',false);
		}
		else
		{
			darkmodeCookie.remove();
		}
	});
};

document.addEventListener('DOMContentLoaded',function()
{
	darkmode_init();
});