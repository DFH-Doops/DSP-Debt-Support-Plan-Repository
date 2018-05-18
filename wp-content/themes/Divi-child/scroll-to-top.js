<script>
var pageHREF = location.href;

if ( pageHREF) {
	if ( window.location.href.indexOf( "gf_1" ) > -1 ) {
		setTimeout(function() {
			console.log( 'Waiting 2sec' );
			document.body.scrollTop = document.documentElement.scrollTop = 0;
		}, 1);
		console.log( 'Page has #gf_1 in url' );
	} else {
		console.log( 'No Instance of #gf_1' );
	}
} else {
	console.log( 'Page has no HREF' );
}
</script>