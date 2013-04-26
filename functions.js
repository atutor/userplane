function single_signon(site_id, key, token, lang)
{
    up.init({
		siteId: site_id,  
		key: key,
		token: token,
		lang: lang, 
		settings: {}
	});
}
