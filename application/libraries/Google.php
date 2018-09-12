<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once APPPATH . 'third_party/google-client/src/Google_Client' . EXT;
//require_once APPPATH . 'third_party/google-client/src/contrib/Google_PlusService' . EXT;
require_once APPPATH . 'third_party/google-client/src/contrib/Google_CalendarService' . EXT;

class Google {

	var $client;

	var $plus;

	var $calendar;

	public function __construct($config = array()) {
		$this -> client = new Google_Client();
		$this -> client -> setAccessType('online');
		// default: offline
		$this -> client -> setApplicationName('PAT 2014');
		$this -> client -> setClientId(''); //fornecidor pelo google
		$this -> client -> setClientSecret('');  //fornecidor pelo google
		$this -> client -> setRedirectUri('http://www.muiraquitec.com.br/pat/index.php/admin/evento/importar');
		$this -> client -> setDeveloperKey('');  //fornecidor pelo google
		//$this -> plus = new Google_PlusService($this -> client);
		$this -> client -> setUseObjects(true);
		$this -> calendar = new Google_CalendarService($this -> client);

	}

	public function autenticar() {
		$this -> client -> authenticate($_GET['code']);
		$token = $this -> client -> getAccessToken();
		$this -> client -> setAccessToken($token);
	}

	public function createAuthUrl() {
		return $this -> client -> createAuthUrl();
	}

	public function importar() {
		try {
			$retorno = "";
			$codeigniter = &get_instance();
			$codeigniter -> load -> model("Unidade_model", "unidades");
			$codeigniter -> load -> model("Evento_model", "eventos");
			$codeigniter -> load -> model("Usuario_model", "usuarios");

			//$responsaveis = $codeigniter -> usuarios -> listar(array("situacao_usuario" => "Habilitado", "tipo_usuario" => "Responsável"));
			$responsaveis = $codeigniter -> usuarios -> listar(array("situacao_usuario" => "Habilitado"));

			// Para os calendarios
			$reminder = new Google_EventReminder();
			$reminder -> setMethod("email");
			$reminder -> setMinutes(1440);

			// Para os eventos
			$reminders = new Google_EventReminders();
			$reminders -> setUseDefault(true);

			$attendees = array();
			foreach ($responsaveis as $responsavel) {
				$attendee1 = new Google_EventAttendee();
				$attendee1 -> setEmail($responsavel -> email_usuario);
				$attendee1 -> setDisplayName($responsavel -> nome_usuario);
				$attendees[] = $attendee1;
			}

			$attendee1 = new Google_EventAttendee();
			$attendee1 -> setEmail("marciobrst@gmail.com");
			$attendee1 -> setDisplayName("Márcio Braga");
			$attendees[] = $attendee1;

			$calendar = new Google_Calendar();
			$calendar -> setSummary("PAT 2014");
			$calendar -> setLocation("Brasil");
			$calendar -> setDescription("Eventos do PAT 2014");
			$calendar -> setTimeZone('America/Belem');
			$createdCalendar = $this -> calendar -> calendars -> insert($calendar);
			$calendarId = $createdCalendar -> getId();

			$calendarListEntry = new Google_CalendarListEntry();
			$calendarListEntry -> setId($calendarId);
			$calendarListEntry -> setDefaultReminders(array($reminder));
			$createdCalendarListEntry = $this -> calendar -> calendarList -> insert($calendarListEntry);

			$colorId = 0;
			$unidades = $codeigniter -> unidades -> listar();
			foreach ($unidades as $unidade) {
				$nunidade = $unidade -> nome_unidade;
				$eventos = $codeigniter -> eventos -> listar(array("codigo_unidade" => $unidade -> codigo_unidade, "situacao_evento" => "Habilitado"));
				$teventos = count($eventos);

				$retorno .= "<p>Unidade $nunidade com $teventos eventos importados</p>";
				if ($teventos == 0) {
					continue;
				} else {
					$colorId = $colorId + 1;
					if ($colorId > 11) {
						$colorId = 1;
					}
				}

				foreach ($eventos as $evento) {

					//echo $evento -> codigo_evento;
					$event = new Google_Event();
					$event -> setSummary($evento -> nome_evento);
					$description = "";

					$description .= "Unidade Responsável:";
					$description .= unidade_nome($evento -> codigo_unidade);
					$description .= "\n";

					$description .= "Tipo de evento:";
					$description .= tipo_nome($evento -> codigo_tipo);
					$description .= "\n";

					$description .= "Público-Alvo:";
					$description .= $evento -> publicoalvo_evento;
					$description .= "\n";

					$description .= "Local:";
					$description .= $evento -> local_evento;
					$description .= "\n";

					$description .= "Cidade:";
					$description .= cidade_nome($evento -> codigo_cidade);
					$description .= "\n";

					$description .= "Realizador:";
					$description .= $evento -> realizador_evento;
					$description .= "\n";

					$event -> setDescription($description);
					$event -> setLocation(cidade_nome($evento -> codigo_cidade));
					if ($evento -> hora_inicio && $evento -> hora_fim) {
						$start = new Google_EventDateTime();
						$start -> setDateTime($evento -> data_evento . "T" . $evento -> hora_inicio . ":00-03:00");
						$event -> setStart($start);

						$end = new Google_EventDateTime();
						$end -> setDateTime($evento -> data_evento . "T" . $evento -> hora_inicio . ":00-03:00");
						$event -> setEnd($end);
					} else {
						$start = new Google_EventDateTime();
						$start -> setDate($evento -> data_evento);
						$event -> setStart($start);

						$end = new Google_EventDateTime();
						$end -> setDate($evento -> data_evento);
						$event -> setEnd($end);
					}

					$event -> attendees = $attendees;
					$event -> setReminders($reminders);
					$event -> setColorId($colorId);

					//$createdEvent = $this -> calendar -> events -> insert('primary', $event);
					$createdEvent = $this -> calendar -> events -> insert($calendarId, $event);

					//break;

					//$createdEvent -> getId();
					$idLocal = $evento -> codigo_evento;
					$idRemoto = $createdEvent -> getId();
					$retorno .= "<p>Evento $idLocal registrado como $idRemoto</p>";
				}
				sleep(2);
			}
			return $retorno;
		} catch (Exception $e) {
			return $e -> getMessage();
		}
	}

}
