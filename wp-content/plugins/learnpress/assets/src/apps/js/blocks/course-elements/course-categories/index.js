/**
 * Register block course categories.
 */

import edit from './edit';
import { save } from './save';
import metadata from './block.json';
import { registerBlockType } from '@wordpress/blocks';
import { checkTemplatesCanLoadBlock } from '../../utilBlock.js';

const templatesName = [
	'learnpress/learnpress//single-lp_course',
	'learnpress/learnpress//single-lp_course-offline',
];

checkTemplatesCanLoadBlock( templatesName, metadata, ( metadataNew ) => {
	registerBlockType( metadataNew.name, {
		...metadataNew,
		edit,
		save,
	} );
} );

registerBlockType( metadata.name, {
	...metadata,
	edit,
	save,
} );
