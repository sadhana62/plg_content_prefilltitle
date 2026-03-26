document.addEventListener('DOMContentLoaded', async () => {
	const titleField = document.getElementById('jform_title');

	if (!titleField) {
		return;
	}

	// Do not overwrite if title already has something
	if (titleField.value.trim() !== '') {
		return;
	}

	// Detect "new article" by checking hidden id field
	const idField = document.getElementById('jform_id');

	if (idField && idField.value && idField.value !== '0') {
		return;
	}

	try {
		const response = await fetch(
			'index.php?option=com_ajax&plugin=prefilltitle&group=content&format=json',
			{
				method: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				}
			}
		);

		const result = await response.json();

		if (
			result &&
			Array.isArray(result.data) &&
			result.data[0] &&
			result.data[0].title
		) {
			titleField.value = result.data[0].title;
			titleField.dispatchEvent(new Event('input', { bubbles: true }));
			titleField.dispatchEvent(new Event('change', { bubbles: true }));
		}
	} catch (error) {
		console.warn('Prefill Title plugin AJAX request failed.', error);
	}
});