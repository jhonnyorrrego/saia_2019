<script type="text/javascript">
	$(document).ready(function() {
		$.fn.addClassSVG = function(className) {
			$(this).attr('class', function(index, existingClassNames) {
				return existingClassNames + ' ' + className;
			});
			return this;
		};

		/*
		 * .removeClassSVG(className)
		 * Removes the specified class to each of the set of matched SVG elements.
		 */
		$.fn.removeClassSVG = function(className) {
			$(this).attr('class', function(index, existingClassNames) {
				var re = new RegExp(className, 'g');
				return existingClassNames.replace(re, '');
			});
			return this;
		};
	}); 
</script>
