import ImageRadio      from './components/field/ImageRadio.vue'
import ImageRadioInput from './components/input/ImageRadioInput.vue'

panel.plugin('sylvainjule/imageradio', {
    fields: {
        imageradio: ImageRadio,
    },
    components: {
    	'k-imageradio-input': ImageRadioInput,
    }
});