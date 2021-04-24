const RequestService = {
    export: async function(data) {
        const apiUrl = '/api/csv-export';
        const config = {responseType: 'arraybuffer'};

        try {
            const response = await axios.patch(apiUrl, data, config);

            return response.data;
        } catch (error) {
            throw error;
        }
    }
};

export default RequestService;
