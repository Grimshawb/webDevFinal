</main>

	<footer container class="siteFooter">
		<p>Design uses <a href="http://concisecss.com/">Concise CSS Framework</a></p>
		<p class="float-right">
			<?
				// Set the time zone, gotta look it up there are tons
				date_default_timezone_set('America/Chicago');

				// There are a ton of date codes to use
				print date('g:i a l F j');
			?>
		</p>
	</footer>
</body>
</html>

<?
	ob_end_flush();
?>
