const handleErrorMixin = {
    data: function() {
        return {
            errors: []
        };
    },

    methods: {
        onError(err) {
            let vm = this;

            if (vm.hasOwnProperty('loading')) {
                vm.loading = false;
            }

            if (err.response && err.response.status === 422) {
                vm.handleValidationError(err.response.data);

                return;
            }

            alert('Something went wrong. Check console for details.');
            console.log(err);
        },

        handleValidationError(data) {
            let vm = this;
            let errors = [];

            for (let key in data.errors) {
                if (! data.errors.hasOwnProperty(key)) {
                    continue;
                }

                errors.push(data.errors[key].join(', '));
            }

            vm.errors = errors;
        }
    }
};

export default handleErrorMixin;
