</main>

	<footer container class="siteFooter">
		<p>Design uses <a href="http://concisecss.com/">Concise CSS Framework</a></p>
		<p class="float-right">
			<?php
				date_default_timezone_set('America/Chicago');

				print date('g:i a l F j Y');
			?>
		</p>
	</footer>
</body>
</html>

<?php
	ob_end_flush();
