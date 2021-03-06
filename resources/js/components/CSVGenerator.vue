<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Table to CSV Generator</div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th></th>
            <th v-for="header in headers">
              <input type="text"
                     class="form-control form-control-sm"
                     :disabled="loading"
                     :class="{'is-invalid': ! header.title.length}"
                     v-model.trim="header.title"/>
            </th>
            <th class="text-center">
              <b-button v-if="! noMoreColumns" variant="outline-primary"
                        :disabled="loading"
                        size="sm"
                        title="Add new column"
                        @click="addColumn">+</b-button>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(row, index) in rows">
            <td class="text-center">
              <b-button :disabled="loading" size="sm" variant="outline-danger" @click="removeRow(index)" title="Remove row">
                <b-icon icon="trash" aria-label="Remove"></b-icon>
              </b-button>
            </td>

            <td v-for="cell in row">
              <input type="text"
                     class="form-control form-control-sm"
                     :class="{'is-invalid': ! cell.val.length}"
                     :disabled="loading"
                     v-model.trim="cell.val"/>
            </td>

            <td></td>
          </tr>
          <tr>
            <td class="text-center" :colspan="headers.length+2">
              <b-button :disabled="loading"
                        size="sm"
                        variant="outline-warning"
                        @click="addRow" title="Add new row">+</b-button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="card-footer text-center">
        <div class="text-danger py-1" v-for="errorMessage in errors">{{ errorMessage }}</div>

        <b-button class="m-3" size="md" @click="submit()" title="Export all data to CSV file" :disabled="loading">
          <b-icon icon="cloud-download" aria-hidden="true"></b-icon> Export to CSV
        </b-button>
      </div>
    </div>
  </div>
</template>

<script>
import RequestService from "../services/RequestService";
import forceDownloadMixin from "../mixins/forceDownloadMixin";
import handleErrorMixin from "../mixins/handleErrorMixin";

export default {
  mixins: [forceDownloadMixin, handleErrorMixin],
  props: {
    columnLimit: {
      type: Number,
      default: 5
    }
  },

  data() {
    return {
      loading: false,
      headers: [{title: 'first_name'}, {title: 'last_name'}, {title: 'email_address'}],
      rows: [
          [{val: 'John'}, {val: 'Doe'}, {val: 'john.doe@example.com'}],
          [{val: 'John'}, {val: 'Smith'}, {val: 'john.smith@example.com'}]
      ]
    }
  },

  methods: {
    addRow() {
      let vm = this;
      let columnsLen = vm.headers.length;
      let createdRow = [];

      if (! columnsLen) {
        return;
      }

      for (let i = 0; i < columnsLen; i++) {
        createdRow.push({val: ''});
      }

      vm.rows.push(createdRow);
    },

    removeRow(index) {
      if (! confirm('Are you sure?')) {
        return;
      }

      this.rows.splice(index, 1);
    },

    addColumn() {
      let vm = this;

      if (vm.headers.length >= vm.columnLimit) {
        return;
      }

      vm.headers.push({title: ''});

      // append cell to every row
      vm.rows.forEach(r => r.push({val: ''}));
    },

    submit() {
      if (! confirm('Are you sure?')) {
        return;
      }

      let vm = this;
      let requestData = {headers: vm.headers, rows: vm.rows};

      vm.loading = true;
      vm.errors = [];

      RequestService.export(requestData)
          .then(function(res) {
            vm.forceFileDownload(res, 'table_data.csv');
            vm.loading = false;
          })
          .catch(vm.onError);
    }
  },

  computed: {
    noMoreColumns() {
      let vm = this;

      return vm.headers.length > vm.columnLimit;
    }
  }
}
</script>

<style scoped>

</style>
