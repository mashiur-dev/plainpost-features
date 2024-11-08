/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';


import CategoryPreview from "./assets/category-list-preview.png";


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	if (!attributes.categories) {
		wp.apiFetch({
			url: "/wp-json/wp/v2/categories?per_page=9",
		}).then((categories) => {
			setAttributes({
				categories,
			});
		});
	}

	if (!attributes.categories) {
		return 'Loading..'
	}

	if (attributes.categories && attributes.categories.length === 0) {
		return "No categories found!";
	}

	return (
		<div {...useBlockProps()}>
			<div className="plainpost-category-list">
				<label>
					{__("Number of Categories", "plainpost-features")}
					<input
						type="text"
						value={attributes.numberOfCategories}
						onChange={(event) => {
							setAttributes({
								numberOfCategories: event.target.value,
							});
						}}
					/>
				</label>

				<img src={CategoryPreview} className="plainpost-category-list-preview" />
			</div>
		</div>
	);
}
