document.addEventListener('DOMContentLoaded', async () => {
	const titleField = document.getElementById('jform_title');

	if (!titleField) {
		console.log('Prefill Title: title field not found');
		return;
	}

	if (titleField.value.trim() !== '') {
		console.log('Prefill Title: title already filled');
		return;
	}

	const idField = document.getElementById('jform_id');

	if (idField && idField.value && idField.value !== '0') {
		console.log('Prefill Title: existing article');
		return;
	}

	try {
		const response = await fetch(
			'index.php?option=com_ajax&plugin=prefilltitle&group=content&format=json',
			{
				method: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
					'Accept': 'application/json'
				}
			}
		);

		const result = await response.json();
		console.log('Prefill Title AJAX result:', result);

		let title = '';

		if (result?.success && Array.isArray(result.data) && result.data[0]?.title) {
			title = result.data[0].title;
		}

		if (!title) {
			console.log('Prefill Title: no title returned');
			return;
		}

		titleField.value = title;
		titleField.dispatchEvent(new Event('input', { bubbles: true }));
		titleField.dispatchEvent(new Event('change', { bubbles: true }));

		console.log('Prefill Title: title applied');
	} catch (error) {
		console.error('Prefill Title AJAX failed:', error);
	}
});