app.config(["$provide",
	function ($provide) {
		$provide.decorator("zeHttp", ["$delegate", function($delegate){
			var zeHttp = $delegate;

			zeHttp.contact = {
				company : {
					context : context_company,
					get : get_company,
					all : getAll_company,
					modal : modal_company,
					save : save_company,
					del : delete_company,
					excel : {
						make : makeExcel_company,
						get : getExcel_company
					}
				},
				contact : {
                    context : context_contact,
					get : get_contact,
					all : getAll_contact,
                    modal : modal_contact,
                    save : save_contact,
                    del : delete_contact,
                    excel : {
                        make : makeExcel_contact,
                        get : getExcel_contact
                    }
				},
				account_families : {
					get : get_accountFamilies,
					get_all : getAll_accountFamilies,
					save : save_accountFamilies,
					save_all : saveAll_accountFamilies,
					del : delete_accountFamilies
				},
				topologies : {
					get : get_topologies,
					get_all : getAll_topologies,
					save : save_topologies,
					save_all : saveAll_topologies,
					del : delete_topologies
				},
				code_naf : {
					modal : modal_codeNaf
				},
                accounting_number : {
                    modal : modal_accountingNumber,
                    save : save_accountingNumber
                },
                countries : {
					all : getAll_countries,
						modal : modal_countries
				},
				states : {
					modal : modal_states
				},
                modality : {
                    get : get_modality,
                    get_all : getAll_modality,
                    save : post_modality,
                    del : del_modality
                },
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;



			function context_company(){
				return zeHttp.get("/com_zeapps_contact/companies/context/");
			}
			function get_company(id){
				return zeHttp.get("/com_zeapps_contact/companies/get/" + id);
			}
			function getAll_company(limit, offset, context, filters){
				return zeHttp.post("/com_zeapps_contact/companies/getAll/" + limit + "/" + offset + "/" + context, filters);
			}
			function modal_company(limit, offset, filters){
				return zeHttp.post("/com_zeapps_contact/companies/modal/" + limit + "/" + offset, filters);
			}
			function save_company(data){
				return zeHttp.post("/com_zeapps_contact/companies/save", data);
			}
			function delete_company(id){
				return zeHttp.delete("/com_zeapps_contact/companies/delete/" + id);
			}
            function makeExcel_company(filters){
                return zeHttp.post("/com_zeapps_contact/companies/make_export/", filters);
            }
            function getExcel_company(link){
                return "/com_zeapps_contact/companies/get_export/"+link;
            }






			function context_contact(){
				return zeHttp.get("/com_zeapps_contact/contacts/context/");
			}
			function get_contact(id){
				return zeHttp.get("/com_zeapps_contact/contacts/get/" + id);
			}
			function getAll_contact(id, limit, offset, context, filters){
				id = id || 0;
				return zeHttp.post("/com_zeapps_contact/contacts/getAll/" + id + "/" + limit + "/" + offset + "/" + context, filters);
			}
            function modal_contact(limit, offset, filters, id_company){
				id_company = id_company || 0;
                return zeHttp.post("/com_zeapps_contact/contacts/modal/" + id_company + "/" + limit + "/" + offset, filters);
            }
            function save_contact(data){
                return zeHttp.post("/com_zeapps_contact/contacts/save/", data);
            }
            function delete_contact(id){
                return zeHttp.delete("/com_zeapps_contact/contacts/delete/" + id);
            }
            function makeExcel_contact(filters){
                return zeHttp.post("/com_zeapps_contact/contacts/make_export/", filters);
            }
            function getExcel_contact(link){
                return "/com_zeapps_contact/contacts/get_export/"+link;
            }






			function get_accountFamilies(id){
				return zeHttp.get("/com_zeapps_contact/account_families/get/" + id);
			}
			function getAll_accountFamilies(){
				return zeHttp.get("/com_zeapps_contact/account_families/get_all/");
			}
			function save_accountFamilies(data){
				return zeHttp.post("/com_zeapps_contact/account_families/save/", data);
			}
			function saveAll_accountFamilies(data){
				return zeHttp.post("/com_zeapps_contact/account_families/save_all/", data);
			}
			function delete_accountFamilies(id){
				return zeHttp.get("/com_zeapps_contact/account_families/delete/" + id);
			}






			function get_topologies(id){
				return zeHttp.get("/com_zeapps_contact/topologies/get/" + id);
			}
			function getAll_topologies(){
				return zeHttp.get("/com_zeapps_contact/topologies/get_all/");
			}
			function save_topologies(data){
				return zeHttp.post("/com_zeapps_contact/topologies/save/", data);
			}
			function saveAll_topologies(data){
				return zeHttp.post("/com_zeapps_contact/topologies/save_all/", data);
			}
			function delete_topologies(id){
				return zeHttp.get("/com_zeapps_contact/topologies/delete/" + id);
			}






			function modal_codeNaf(limit, offset, filters){
                return zeHttp.post("/com_zeapps_contact/code_naf/modal/" + limit + "/" + offset, filters)
			}





            // ACCOUNTING NUMBERS
            function modal_accountingNumber(limit, offset, filters){
                return zeHttp.post("/com_zeapps_contact/accounting_numbers/modal/" + limit + "/" + offset, filters)
            }
            function save_accountingNumber(data){
                return zeHttp.post("/com_zeapps_contact/accounting_numbers/save", data)
            }



            // COUNTRIES
            function getAll_countries(){
                return zeHttp.get("/com_zeapps_contact/country/get_all/");
            }
            function modal_countries(limit, offset, filters){
                return zeHttp.post("/com_zeapps_contact/country/modal/" + limit + "/" + offset, filters);
            }



            // STATES
            function modal_states(limit, offset, filters){
                return zeHttp.post("/com_zeapps_contact/state/modal/" + limit + "/" + offset, filters);
            }



            // MODALITY
            function get_modality(id){
                return zeHttp.get("/com_zeapps_contact/modalities/get/" + id);
            }
            function getAll_modality(){
                return zeHttp.get("/com_zeapps_contact/modalities/getAll/");
            }
            function post_modality(data){
                return zeHttp.post("/com_zeapps_contact/modalities/save", data);
            }
            function del_modality(id){
                return zeHttp.delete("/com_zeapps_contact/modalities/delete/" + id);
            }

		}]);
	}]);