import ImageRadio            from './components/field/ImageRadio.vue'
import ImageRadioInput       from './components/input/ImageRadioInput.vue'
import ImageRadioChoiceInput from './components/input/ImageRadioChoiceInput.vue'
import ImageRadioPreview     from './components/previews/ImageRadioPreview.vue'

panel.plugin('sylvainjule/imageradio', {
    fields: {
        imageradio: ImageRadio,
    },
    components: {
    	'k-imageradio-input': ImageRadioInput,
        'k-imageradio-choice-input': ImageRadioChoiceInput,
        'k-imageradio-field-preview': ImageRadioPreview,
    }
});
