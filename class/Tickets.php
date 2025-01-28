<?php

class Tickets extends Database
{
    private $ticketTable = 'hd_tickets';
    private $ticketRepliesTable = 'hd_ticket_replies';
    private $departmentsTable = 'hd_departments';
    private $dbConnect = false;

    public function __construct()
    {
        $this->dbConnect = $this->dbConnect();
    }
    
    public function showTickets()
    {
        $sqlWhere = '';
        $params = [];
        $isSearch = !empty($_POST["search"]["value"]);

        if ($isSearch) {
            $sqlWhere = "WHERE uniqid LIKE ? OR title LIKE ? OR resolved LIKE ? OR last_reply LIKE ?";
            $searchValue = "%" . $_POST["search"]["value"] . "%";
            $params[] = $searchValue;
            $params[] = $searchValue;
            $params[] = $searchValue;
            $params[] = $searchValue;
        }

        $sqlQuery = "
    SELECT t.id, t.uniqid, t.title, t.init_msg AS message, t.date, t.last_reply, 
           t.resolved, u.name AS creater, d.name AS department, u.user_type, 
           t.user, t.user_read, t.admin_read, t.branch, t.priority
    FROM hd_tickets t
    LEFT JOIN hd_users u ON t.user = u.id
    LEFT JOIN hd_departments d ON t.department = d.id
    $sqlWhere
";

        if (!empty($_POST["order"])) {
            $sqlQuery .= " ORDER BY " . $_POST['order']['0']['column'] . " " . $_POST['order']['0']['dir'];
        } else {
            $sqlQuery .= " ORDER BY t.id DESC";
        }

        if ($_POST["length"] != -1) {
            $sqlQuery .= " LIMIT ?, ?";
            $params[] = intval($_POST['start']);
            $params[] = intval($_POST['length']);
        }

        $stmt = $this->dbConnect->prepare($sqlQuery);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $numRows = $result->num_rows;

        $ticketData = [];
        while ($ticket = $result->fetch_assoc()) {
            $ticketRows = [];
            $status = $ticket['resolved'] == 0 ? 
                '<span class="label label-success">Open</span>' : 
                '<span class="label label-danger">Closed</span>';

            // Format branch with color labels
            $branchLabel = '';
            switch($ticket['branch']) {
                case 'Panji':
                    $branchLabel = '<span class="label label-primary">Panji</span>';
                    break;
                case 'KTCC':
                    $branchLabel = '<span class="label label-info">KTCC</span>';
                    break;
                default:
                    $branchLabel = '<span class="label label-default">' . htmlspecialchars($ticket['branch']) . '</span>';
            }

            $title = $ticket['title'];
            if (
                (isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) ||
                (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
                $title = $this->getRepliedTitle($ticket['title']);
            }

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $dateFormatted = date('d-m-Y', $ticket['date']);
            $timeFormatted = date('h:i:s A', $ticket['date']);

            $ticketRows[] = $ticket['id'];
            $ticketRows[] = $ticket['uniqid'];
            $ticketRows[] = $title;
            $ticketRows[] = $ticket['department'];
            $ticketRows[] = $ticket['creater'];
            $ticketRows[] = $dateFormatted . '<br>' . $timeFormatted;
            $ticketRows[] = $status;
            $ticketRows[] = '<a href="view_ticket.php?id=' . $ticket["uniqid"] . '" class="btn btn-success btn-xs update">View Ticket</a>';
            $ticketRows[] = '<button type="button" name="update" id="' . $ticket["id"] . '" class="btn btn-warning btn-xs update">Edit</button>'; 
            $ticketRows[] = '<button type="button" name="delete" id="' . $ticket["id"] . '" class="btn btn-danger btn-xs delete">Close</button>';
            $ticketRows[] = '<button type="button" name="deleteTicket" id="' . $ticket["id"] . '" class="btn btn-danger btn-xs deleteTicket">Delete</button>';
            $ticketRows[] = $branchLabel;
            $ticketData[] = $ticketRows;
        }

        $output = [
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $ticketData
        ];

        echo json_encode($output);
    }

    public function getRepliedTitle($title)
    {
        return $title . '<span class="answered">Answered</span>';
    }


    public function createTicket()
    {
        if (!empty($_POST['subject']) && !empty($_POST['message']) && !empty($_POST['branch']) && !empty($_POST['payment'])) {
            $date = new DateTime();
            $date = $date->getTimestamp();
            
            // Generate a 5-digit ticket ID
            $uniqid = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            
            // Check if this ID already exists to avoid duplicates
            while ($this->ticketIdExists($uniqid)) {
                $uniqid = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            }
            
            // Sanitize inputs separately
            $subject = strip_tags($_POST['subject']);
            $message = strip_tags($_POST['message']);
            $branch = strip_tags($_POST['branch']);
            $payment = strip_tags($_POST['payment']);
            $userId = $_SESSION["userid"];
            $department = $_POST['department'];
            $status = $_POST['status'];
            
            // Format payment with RM prefix
            $payment = 'RM ' . number_format(floatval($_POST['payment']), 2);
            
            // Add client info to the query
            $queryInsert = "INSERT INTO " . $this->ticketTable . " 
            (uniqid, user, title, init_msg, department, date, last_reply, user_read, 
             admin_read, resolved, branch, priority, payment, client_name, client_phone) 
            VALUES('" . $uniqid . "', '" . $userId . "', '" . $subject . "', '" . $message . "', 
                    '" . $department . "', '" . $date . "', '" . $userId . "', 0, 0, '" . $status . "', 
                    '" . $branch . "', '" . $_POST['priority'] . "', '" . $payment . "', 
                    '" . mysqli_real_escape_string($this->dbConnect, $_POST['client_name']) . "', 
                    '" . mysqli_real_escape_string($this->dbConnect, $_POST['client_phone']) . "')";
            
            if (mysqli_query($this->dbConnect, $queryInsert)) {
                echo 'success ' . $uniqid;
            } else {
                echo '<div class="alert error">Error creating ticket: ' . mysqli_error($this->dbConnect) . '</div>';
            }
        } else {
            echo '<div class="alert error">Please fill in all fields.</div>';
        }
    }

  private function ticketIdExists($uniqid) {
      $stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM " . $this->ticketTable . " WHERE uniqid = ?");
      $stmt->bind_param('s', $uniqid);
      $stmt->execute();
      $result = $stmt->get_result();
      $count = $result->fetch_row()[0];
      return $count > 0;
  }

  public function getTicketDetails()
  {
        if ($_POST['ticketId']) {
            $stmt = $this->dbConnect->prepare("SELECT * FROM " . $this->ticketTable . " WHERE id = ?");
            $stmt->bind_param('i', $_POST['ticketId']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            echo json_encode($row);
        }
    }

    public function updateTicket()
    {
        if ($_POST['ticketId']) {
            $updateQuery = "UPDATE " . $this->ticketTable . " 
    SET title = ?, department = ?, init_msg = ?, resolved = ?, branch = ?, 
        priority = ?, payment = ?, client_name = ?, client_phone = ?
    WHERE id = ?";
                
            $stmt = $this->dbConnect->prepare($updateQuery);
            $stmt->bind_param('sisisssss', 
                $_POST["subject"],
                $_POST["department"],
                $_POST["message"],
                $_POST["status"],
                $_POST["branch"],
                $_POST["priority"],
                $_POST["payment"],
                $_POST["client_name"],
                $_POST["client_phone"],
                $_POST["ticketId"]
            );
            
            return $stmt->execute();
        }
        return false;
    }

    public function closeTicket()
    {
        if ($_POST["ticketId"]) {
            $stmt = $this->dbConnect->prepare("UPDATE " . $this->ticketTable . " 
                SET resolved = 1, resolved_at = NOW(), invoice_number = ?
                WHERE id = ?");
            
            // Generate invoice number (format: INV-YYYYMMDD-XXXXX)
            $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            
            $stmt->bind_param('si', $invoiceNumber, $_POST["ticketId"]);
            $stmt->execute();
        }
    }

    public function getInvoiceDetails($ticketId) {
        $stmt = $this->dbConnect->prepare("
            SELECT t.*, u.name as customer_name, d.name as department_name 
            FROM " . $this->ticketTable . " t 
            LEFT JOIN hd_users u ON t.user = u.id 
            LEFT JOIN hd_departments d ON t.department = d.id 
            WHERE t.id = ?");
        $stmt->bind_param('i', $ticketId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getDepartments()
    {
        $sqlQuery = "SELECT * FROM " . $this->departmentsTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        while ($department = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
        }
    }

    public function ticketInfo($id)
    {
        $stmt = $this->dbConnect->prepare("
            SELECT t.id, t.uniqid, t.title, t.user, t.init_msg as message, 
                t.date, t.last_reply, t.resolved, t.branch, t.priority, t.payment,
                t.client_name, t.client_phone,
                u.name as creater, d.name as department 
            FROM " . $this->ticketTable . " t 
            LEFT JOIN hd_users u ON t.user = u.id 
            LEFT JOIN hd_departments d ON t.department = d.id 
            WHERE t.uniqid = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function saveTicketReplies()
    {
        if ($_POST['message']) {
            $date = new DateTime();
            $date = $date->getTimestamp();
            
            $stmt = $this->dbConnect->prepare("INSERT INTO " . $this->ticketRepliesTable . " 
                (user, text, ticket_id, date) VALUES(?, ?, ?, ?)");
            $stmt->bind_param('isis', 
                $_SESSION["userid"],
                $_POST['message'],
                $_POST['ticketId'],
                $date
            );
            $stmt->execute();

            $updateStmt = $this->dbConnect->prepare("UPDATE " . $this->ticketTable . " 
                SET last_reply = ?, user_read = 0, admin_read = 0 
                WHERE id = ?");
            $updateStmt->bind_param('ii',
                $_SESSION["userid"],
                $_POST['ticketId']
            );
            $updateStmt->execute();
        }
    }

    public function getTicketReplies($id)
    {
        $stmt = $this->dbConnect->prepare("
            SELECT r.id, r.text as message, r.date, u.name as creater, 
                   d.name as department, u.user_type  
            FROM " . $this->ticketRepliesTable . " r
            LEFT JOIN " . $this->ticketTable . " t ON r.ticket_id = t.id
            LEFT JOIN hd_users u ON r.user = u.id 
            LEFT JOIN hd_departments d ON t.department = d.id 
            WHERE r.ticket_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateTicketReadStatus($ticketId)
    {
        $updateField = isset($_SESSION["admin"]) ? "admin_read = 1" : "user_read = 1";
        $stmt = $this->dbConnect->prepare("UPDATE " . $this->ticketTable . " 
            SET " . $updateField . " WHERE id = ?");
        $stmt->bind_param('i', $ticketId);
        $stmt->execute();
    }

    public function deleteTicket($id) {
        $stmt = $this->dbConnect->prepare("DELETE FROM " . $this->ticketTable . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $stmt2 = $this->dbConnect->prepare("DELETE FROM " . $this->ticketRepliesTable . " WHERE ticket_id = ?");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            return true;
        }
        return false;
    }
}