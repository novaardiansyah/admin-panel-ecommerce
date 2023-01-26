$(document).ready(function () {
	listMenu();
});

let defaultTable = $("#listMenu");
let defaultSelector = "listMenu";
let defaultUrl = base_url("master-data/menu/list-menu");

function listMenu() {
	$.ajax({
		url: defaultUrl,
		type: "GET",
		dataType: "json",
		success: function (response) {
			if (response.status !== undefined) {
				if (response.status == true && response.status_code == 200) {
					let data = response.data;

					let thead = defaultTable.find("thead").html();
					let tbody = defaultTable.find("tbody").html("");
					defaultTable.append(`<tfoot>${thead}</tfoot>`);

					Object.keys(data).forEach((key) => {
						let value = data[key];

						tbody.append(`
              <tr>
                <td>${parseInt(key) + 1}</td>
                <td>${value.name}</td>
                <td>${value.url}</td>
                <td>${value.icon}</td>
                <td>${
									parseInt(value.isActive) == 1
										? '<span class="badge badge-success">Active</span>'
										: '<span class="badge badge-danger">Not-Active</span>'
								}</td>
                <td>${
                  value.updatedAt ? moment(moment(value.updatedAt).format('YYYY-MM-DD HH:MM'), "YYYYMMDD") : moment(value.createdAt, "YYYYMMDD").fromNow()
                }</td>
                <td>
                  <button class="btn btn-sm btn-success d-flex align-items-center">
                    <i class="fa fa-fw fa-edit"></i>&nbsp;
                    <span class="d-none d-md-block">Edit</span>
                </td>
              </tr>
            `);
					});

					return createDatatable(defaultSelector, defaultUrl);
				}

				if (response.status == false && response.status_code == 400) {
					return ToastsAlert({ type: "error", message: response.message });
				}
			}

			log_server_error(url, response);
			return console.log("Internal server error-1: ", response);
		},
		error: function (response) {
			log_server_error(url, response);
			return console.log("Internal server error-2: ", response);
		},
	});
}
