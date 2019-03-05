/**
 * WordPress dependencies
 */
const { DatePicker, PanelBody, PanelRow, SelectControl, ToggleControl } = wp.components;
const { InspectorControls } = wp.editor;
const { Component, Fragment } = wp.element;
const { __ } = wp.i18n;

/**
 * Internal dependencies
 */
import ImageAlignmentControl from '../shared/image-alignment';

class SessionsInspectorControls extends Component {
	render() {
		const { attributes, setAttributes, blockData } = this.props;
		const { show_speaker, show_images, image_size, image_align, content, excerpt_more, show_meta, show_category, sort, filter_date, date } = attributes;
		const { start_date, options, schema } = blockData;

		return(
			<InspectorControls>
				<PanelBody title={ __( 'Content Settings', 'wordcamporg' ) } initialOpen={ true }>
					<PanelRow>
						<SelectControl
							label={ __( 'Description', 'wordcamporg' ) }
							value={ content }
							options={ options.content }
							onChange={ ( value ) => setAttributes( { content: value } ) }
						/>
					</PanelRow>
					{ 'excerpt' === content &&
						<PanelRow>
							<ToggleControl
								label={ __( 'Read More Link', 'wordcamporg' ) }
								help={ __( 'Show a link at the end of the excerpt (some themes already include this)', 'wordcamporg' ) }
								checked={ excerpt_more }
								onChange={ ( value ) => setAttributes( { excerpt_more: value } ) }
							/>
						</PanelRow>
					}
					<PanelRow>
						<ToggleControl
							label={ __( 'Details', 'wordcamporg' ) }
							help={ __( 'Show date, time, and track.', 'wordcamporg' ) }
							checked={ show_meta }
							onChange={ ( value ) => setAttributes( { show_meta: value } ) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label={ __( 'Categories', 'wordcamporg' ) }
							help={ __( 'Show session categories.', 'wordcamporg' ) }
							checked={ show_category }
							onChange={ ( value ) => setAttributes( { show_category: value } ) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label={ __( 'Speakers', 'wordcamporg' ) }
							help={ __( 'Show session speakers.', 'wordcamporg' ) }
							checked={ show_speaker }
							onChange={ ( value ) => setAttributes( { show_speaker: value } ) }
						/>
					</PanelRow>
				</PanelBody>

				<PanelBody title={ __( 'Image Settings', 'wordcamporg' ) }>

				</PanelBody>

				<PanelBody title={ __( 'Sorting and Filtering', 'wordcamporg' ) }>
					<PanelRow>
						<SelectControl
							label={ __( 'Sort by', 'wordcamporg' ) }
							value={ sort }
							options={ options.sort }
							onChange={ ( value ) => setAttributes( { sort: value } ) }
						/>
					</PanelRow>
					{ start_date &&
						<Fragment>
							<PanelRow>
								<ToggleControl
									label={ __( 'Filter by date', 'wordcamporg' ) }
									help={ __( 'Show sessions from a specific date.', 'wordcamporg' ) }
									checked={ filter_date }
									onChange={ ( value ) => setAttributes( { filter_date: value } ) }
								/>
							</PanelRow>
							{ filter_date &&
								<PanelRow>
									<DatePicker
										currentDate={ date ? new Date( date ) : new Date( start_date ) }
										onChange={ ( value ) => setAttributes( { date: value } ) }
									/>
								</PanelRow>
							}
						</Fragment>
					}
				</PanelBody>
			</InspectorControls>
		);
	}
}

export default SessionsInspectorControls;
