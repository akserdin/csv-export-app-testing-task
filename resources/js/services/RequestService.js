const RequestService = {
    export: async function(data) {
        const apiUrl = '/api/csv-export';

        try {
            const response = await axios.patch(apiUrl, data);

            return response.data;
        } catch (error) {
            throw error;
        }
    }
};

export default RequestService;
