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
import { InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import TrendingPosts from "./assets/trending-posts.png";

import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({attributes, setAttributes}) {
	return [
		<InspectorControls>
			<PanelBody title={__("Trending Posts", "plainpost-features")}>
				<TextControl
					label={__("Number of Posts", "plainpost-features")}
					help={__("The number of posts should be 3, 6, or 9...", "plainpost-features")}
					value={attributes.numberOfPosts}
					onChange={(numberOfPosts) => {
						setAttributes({ numberOfPosts });
					}}
				/>
			</PanelBody>
		</InspectorControls>,

		<div {...useBlockProps()}>
			<div className="plainpost-trending-posts">
				<img src={TrendingPosts} className="plainpost-trending-posts-preview" />
			</div>
		</div>,
	];
}
