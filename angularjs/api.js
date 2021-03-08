app.config(["$provide",
    function ($provide) {
        $provide.decorator("zeHttp", ["$delegate", function ($delegate) {
            var zeHttp = $delegate;

            zeHttp.contact = {
                address: {
                    get: get_address,
                    getText: get_text_address,
                },
                company: {
                    context: context_company,
                    get: get_company,
                    all: getAll_company,
                    searchDuplicate: searchDuplicate_company,
                    modal: modal_company,
                    save: save_company,
                    del: delete_company,
                    save_address: save_company_address,
                    del_address: delete_company_address,
                    excel: {
                        make: makeExcel_company,
                        get: getExcel_company
                    }
                },
                contact: {
                    context: context_contact,
                    get: get_contact,
                    all: getAll_contact,
                    searchDuplicate: searchDuplicate_contact,
                    modal: modal_contact,
                    save: save_contact,
                    del: delete_contact,
                    save_address: save_contact_address,
                    del_address: delete_contact_address,
                    excel: {
                        make: makeExcel_contact,
                        get: getExcel_contact
                    }
                },
                account_families: {
                    get: get_accountFamilies,
                    get_all: getAll_accountFamilies,
                    save: save_accountFamilies,
                    save_all: saveAll_accountFamilies,
                    del: delete_accountFamilies
                },
                topologies: {
                    get: get_topologies,
                    get_all: getAll_topologies,
                    save: save_topologies,
                    save_all: saveAll_topologies,
                    del: delete_topologies
                },
                code_naf: {
                    modal: modal_codeNaf
                },
                accounting_number: {
                    all: getAll_accountingNumber,
                    modal: modal_accountingNumber,
                    save: save_accountingNumber,
                    del: del_accountingNumber
                },
                countries: {
                    all: getAll_countries,
                    modal: modal_countries
                },
                states: {
                    modal: modal_states
                },
                modality: {
                    get: get_modality,
                    get_all: getAll_modality,
                    save: post_modality,
                    del: del_modality
                },
            };

            zeHttp.config = angular.extend(zeHttp.config || {}, {});

            return zeHttp;



			function get_address(id_company, id_address_company, id_contact, id_address_contact, typeAdresse) {
				var filters = {};
				filters.id_company = id_company ;
				filters.id_address_company = id_address_company ;
				filters.id_contact = id_contact ;
				filters.id_address_contact = id_address_contact ;
				filters.typeAdresse = typeAdresse ;
				return zeHttp.post("/com_zeapps_contact/address/get?" + zeappsUrlRandom(), filters);
			}


            function get_text_address(id_company, id_address_company, id_contact, id_address_contact, typeAdresse) {
                var filters = {};
                filters.id_company = id_company ;
                filters.id_address_company = id_address_company ;
                filters.id_contact = id_contact ;
                filters.id_address_contact = id_address_contact ;
                filters.typeAdresse = typeAdresse ;
                return zeHttp.post("/com_zeapps_contact/address/getText?" + zeappsUrlRandom(), filters);
            }




            function context_company() {
                return zeHttp.get("/com_zeapps_contact/companies/context/?" + zeappsUrlRandom());
            }

            function get_company(id) {
                return zeHttp.get("/com_zeapps_contact/companies/get/" + id + "?" + zeappsUrlRandom());
            }

            function getAll_company(limit, offset, context, filters) {
                return zeHttp.post("/com_zeapps_contact/companies/getAll/" + limit + "/" + offset + "/" + context + "?" + zeappsUrlRandom(), filters);
            }

            function searchDuplicate_company(filters) {
                return zeHttp.post("/com_zeapps_contact/companies/searchDuplicate?" + zeappsUrlRandom(), filters);
            }

            function modal_company(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/companies/modal/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters);
            }

            function save_company(data) {
                return zeHttp.post("/com_zeapps_contact/companies/save?" + zeappsUrlRandom(), data);
            }

            function delete_company(id) {
                return zeHttp.delete("/com_zeapps_contact/companies/delete/" + id + "?" + zeappsUrlRandom());
            }

            function makeExcel_company(filters) {
                return zeHttp.post("/com_zeapps_contact/companies/make_export/?" + zeappsUrlRandom(), filters);
            }

            function getExcel_company(link) {
                return "/com_zeapps_contact/companies/get_export/" + link + "?" + zeappsUrlRandom();
            }

            function save_company_address(data) {
                return zeHttp.post("/com_zeapps_contact/companies/save_address/?" + zeappsUrlRandom(), data);
            }

            function delete_company_address(id) {
                return zeHttp.delete("/com_zeapps_contact/companies/delete_address/" + id + "?" + zeappsUrlRandom());
            }


            function context_contact() {
                return zeHttp.get("/com_zeapps_contact/contacts/context/?" + zeappsUrlRandom());
            }

            function get_contact(id) {
                return zeHttp.get("/com_zeapps_contact/contacts/get/" + id + "?" + zeappsUrlRandom());
            }

            function getAll_contact(id, limit, offset, context, filters) {
                id = id || 0;
                return zeHttp.post("/com_zeapps_contact/contacts/getAll/" + id + "/" + limit + "/" + offset + "/" + context + "?" + zeappsUrlRandom(), filters);
            }

            function searchDuplicate_contact(filters) {
                return zeHttp.post("/com_zeapps_contact/contacts/searchDuplicate?" + zeappsUrlRandom(), filters);
            }

            function modal_contact(limit, offset, filters, id_company) {
                id_company = id_company || 0;
                return zeHttp.post("/com_zeapps_contact/contacts/modal/" + id_company + "/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters);
            }

            function save_contact(data) {
                return zeHttp.post("/com_zeapps_contact/contacts/save/?" + zeappsUrlRandom(), data);
            }

            function delete_contact(id) {
                return zeHttp.delete("/com_zeapps_contact/contacts/delete/" + id + "?" + zeappsUrlRandom());
            }

            function makeExcel_contact(filters) {
                return zeHttp.post("/com_zeapps_contact/contacts/make_export/?" + zeappsUrlRandom(), filters);
            }

            function getExcel_contact(link) {
                return "/com_zeapps_contact/contacts/get_export/" + link + "?" + zeappsUrlRandom();
            }

            function save_contact_address(data) {
                return zeHttp.post("/com_zeapps_contact/contacts/save_address/?" + zeappsUrlRandom(), data);
            }

            function delete_contact_address(id) {
                return zeHttp.delete("/com_zeapps_contact/contacts/delete_address/" + id + "?" + zeappsUrlRandom());
            }


            function get_accountFamilies(id) {
                return zeHttp.get("/com_zeapps_contact/account_families/get/" + id + "?" + zeappsUrlRandom());
            }

            function getAll_accountFamilies() {
                return zeHttp.get("/com_zeapps_contact/account_families/get_all?" + zeappsUrlRandom());
            }

            function save_accountFamilies(data) {
                return zeHttp.post("/com_zeapps_contact/account_families/save?" + zeappsUrlRandom(), data);
            }

            function saveAll_accountFamilies(data) {
                return zeHttp.post("/com_zeapps_contact/account_families/save_all/?" + zeappsUrlRandom(), data);
            }

            function delete_accountFamilies(id) {
                return zeHttp.get("/com_zeapps_contact/account_families/delete/" + id + "?" + zeappsUrlRandom());
            }


            function get_topologies(id) {
                return zeHttp.get("/com_zeapps_contact/topologies/get/" + id + "?" + zeappsUrlRandom());
            }

            function getAll_topologies() {
                return zeHttp.get("/com_zeapps_contact/topologies/get_all/?" + zeappsUrlRandom());
            }

            function save_topologies(data) {
                return zeHttp.post("/com_zeapps_contact/topologies/save/?" + zeappsUrlRandom(), data);
            }

            function saveAll_topologies(data) {
                return zeHttp.post("/com_zeapps_contact/topologies/save_all/?" + zeappsUrlRandom(), data);
            }

            function delete_topologies(id) {
                return zeHttp.get("/com_zeapps_contact/topologies/delete/" + id + "?" + zeappsUrlRandom());
            }


            function modal_codeNaf(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/code_naf/modal/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters)
            }


            // ACCOUNTING NUMBERS
            function getAll_accountingNumber(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/accounting_numbers/getAll/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters);
            }

            function modal_accountingNumber(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/accounting_numbers/modal/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters)
            }

            function save_accountingNumber(data) {
                return zeHttp.post("/com_zeapps_contact/accounting_numbers/save?" + zeappsUrlRandom(), data)
            }

            function del_accountingNumber(id) {
                return zeHttp.delete("/com_zeapps_contact/accounting_numbers/delete/" + id + "?" + zeappsUrlRandom());
            }


            // COUNTRIES
            function getAll_countries() {
                return zeHttp.get("/com_zeapps_contact/country/get_all/?" + zeappsUrlRandom());
            }

            function modal_countries(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/country/modal/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters);
            }


            // STATES
            function modal_states(limit, offset, filters) {
                return zeHttp.post("/com_zeapps_contact/state/modal/" + limit + "/" + offset + "?" + zeappsUrlRandom(), filters);
            }


            // MODALITY
            function get_modality(id) {
                return zeHttp.get("/com_zeapps_contact/modalities/get/" + id + "?" + zeappsUrlRandom());
            }

            function getAll_modality() {
                return zeHttp.get("/com_zeapps_contact/modalities/getAll/?" + zeappsUrlRandom());
            }

            function post_modality(data) {
                return zeHttp.post("/com_zeapps_contact/modalities/save?" + zeappsUrlRandom(), data);
            }

            function del_modality(id) {
                return zeHttp.delete("/com_zeapps_contact/modalities/delete/" + id + "?" + zeappsUrlRandom());
            }
        }]);
    }]);