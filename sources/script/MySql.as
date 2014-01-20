class script.MySql extends LoadVars {
	private var phpFile;
	private var trace_query;
	private var debug;
	function MySql(urlPhpFile,trace_debug) {
		this.debug=trace_debug;
		this.phpFile=urlPhpFile;
		this.traceError();
	}
	public function insertQuery(stringQuery) {
		this.trace_query=stringQuery;
		this.flash_to_mysql_action="insert";
		this.sendAndLoad(this.phpFile, this, "POST");
	}
	public function updateQuery(stringQuery) {
		this.trace_query=stringQuery;
		this.flash_to_mysql_action="update";
		this.sendAndLoad(this.phpFile, this, "POST");
	}
	public function selectQuery(stringQuery) {
		this.trace_query=stringQuery;
		this.flash_to_mysql_action="select";
		this.sendAndLoad(this.phpFile, this, "POST");
	}
	public function deleteQuery(stringQuery) {
		this.trace_query=stringQuery;
		this.flash_to_mysql_action="delete";
		this.sendAndLoad(this.phpFile, this, "POST");
	}
	public function traceError() {
		if (this.debug) {
			if (this.trace_query == undefined) {
				this.trace_query = "Query non definita";
			}
			if (this.trace_query_r == undefined) {
				this.trace_query_r = "Query di Ritorno non definita";
			}
			if (this.trace_error == undefined) {
				this.trace_error = "Nessun errore di MySQL";
			}
			if (this.numrows == undefined) {
				this.numrows = "Numero di righe non definito";
			}
			if (this.flash_to_mysql_action=="insert") {
				trace("Query Inviata: "+this.trace_query);
				trace("Query Eseguita: "+this.trace_query_r);
				trace("Errore MySql: "+this.trace_error+"\n");
			}
			else if (this.flash_to_mysql_action=="select") {
				trace("Query Inviata: "+this.trace_query);
				trace("Query Eseguita: "+this.trace_query_r);
				trace("Righe Totali: "+this.numrows);
				trace("Errore MySql: "+this.trace_error+"\n");
			}
			else if (this.flash_to_mysql_action=="update") {
				trace("Query Inviata: "+this.trace_query);
				trace("Query Eseguita: "+this.trace_query_r);
				trace("Errore MySql: "+this.trace_error+"\n");
			}			
			else if (this.flash_to_mysql_action=="delete") {
				trace("Query Inviata: "+this.trace_query);
				trace("Query Eseguita: "+this.trace_query_r);
				trace("Errore MySql: "+this.trace_error+"\n");
			}
			else {
				trace("Errore MySql: "+this.trace_error+"\n");
			}
		}
		else {
			trace("Debug non attivo");
		}
	}
}