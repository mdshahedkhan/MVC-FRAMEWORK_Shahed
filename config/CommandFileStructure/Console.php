<?php
namespace App\Config\CommandFileStructure;

use App\Config\Log;
use App\Config\Schema;

class Console
{
    private static string $ROOT_DIR_Command = __DIR__ . "/";
    private static array  $receivedCommand;
    private const CreateServerIP = "php -S 127.0.0.1:8080 -t public";

    private const SERVE = 'serve', MakeController = 'make:controller', MakeModel = 'make:model', MakeMigration = 'make:migration', migrate = 'migrate';
    private static array $command = [self::SERVE => self::SERVE, self::MakeController => self::MakeController, self::MakeModel => self::MakeModel, self::MakeMigration => self::MakeMigration, self::migrate => self::migrate];

    public function __construct($receivedCommand)
    {
        self::$receivedCommand  = $receivedCommand;
        self::$ROOT_DIR_Command = __DIR__ . "/";
    }

    /**
     * @return bool
     */
    private static function checkCommand(): bool
    {
        if (!in_array(self::$receivedCommand[1], self::$command)):
            Log::error("Wrong command: " . self::$receivedCommand[1]);
            return false;
        endif;
        return true;
    }

    /**
     * @return void
     */
    public static function serve(): void
    {
        if (self::checkCommand() === true && self::$command[self::SERVE] === self::$receivedCommand[1]) {
            Log::success("Server Is Running...");
            shell_exec(self::CreateServerIP);
        }
    }


    public function migration(): void
    {
        if (self::checkCommand() === true && self::$command[self::migrate] === self::$receivedCommand[1]) {
            Schema::runQuery();
        }
    }


    /**
     * @return void
     */
    public static function MakeController(): void
    {
        $ControllerName = isset(self::$receivedCommand[2]) ?? "";
        $makeController = isset(self::$receivedCommand[1]) ?? "";
        if (self::checkCommand() === true && in_array($makeController, self::$command) && self::MakeController === self::$receivedCommand[1]) {
            if (!$ControllerName == '') {
                $ControllerCreateLink = sprintf("%s/../../app/Http/Controllers/%s.php", __DIR__, self::$receivedCommand[2]);
                if (!file_exists($ControllerCreateLink)) {
                    $controllerSlash = strpos(self::$receivedCommand[2], '/') ?? false;
                    if ($controllerSlash) {
                        $explodeControllerName = explode("/", self::$receivedCommand[2]);
                        $controllerName        = end($explodeControllerName);
                    } else {
                        $controllerName = self::$receivedCommand[2];
                    }
                    $ControllerStructure    = str_replace("{{Controller}}", $controllerName, file_get_contents(__DIR__ . "/Controller.txt"));
                    $ControllerNamePosition = strpos(self::$receivedCommand[2], "/") ?? false;
                    $directoryArr           = explode("/", self::$receivedCommand[2]);
                    if ($ControllerNamePosition) {
                        if (!is_dir(__DIR__ . "/../../app/Http/Controllers/$directoryArr[0]")) {
                            mkdir(__DIR__ . "/../../app/Http/Controllers/$directoryArr[0]");
                        }
                        $repNameSpc          = "\\" . $directoryArr[0];
                        $ControllerStructure = str_replace("{{\directory}}", $repNameSpc, $ControllerStructure);
                    } else {
                        $ControllerStructure = str_replace("{{\directory}}", "", $ControllerStructure);
                    }
                    file_put_contents($ControllerCreateLink, $ControllerStructure);
                    Log::success("Successfully controller created . ");
                } else {
                    Log::error("This controller is already has been exists . ");
                }

            } else {
                Log::error("You didn't name the controller");
            }
        }
    }

    /**
     * @return void
     */
    public static function MakeModel(): void
    {
        $ModelName = isset(self::$receivedCommand[2]) ?? "";
        $makeModel = isset(self::$receivedCommand[1]) ?? "";
        if (self::checkCommand() === true && in_array($makeModel, self::$command) && self::MakeModel === self::$receivedCommand[1]) {
            if (!$ModelName == '') {
                $ModelCreateLink = __DIR__ . "/../../app/Models/" . self::$receivedCommand[2] . ".php";
                if (!file_exists($ModelCreateLink)) {
                    $controllerSlash = strpos(self::$receivedCommand[2], '/') ?? false;
                    if ($controllerSlash) {
                        $explodeControllerName = explode("/", self::$receivedCommand[2]);
                        $controllerName        = end($explodeControllerName);
                    } else {
                        $controllerName = self::$receivedCommand[2];
                    }
                    $ModelStructure         = str_replace("{{Model}}", $controllerName, file_get_contents(__DIR__ . "/Model.txt"));
                    $ControllerNamePosition = strpos(self::$receivedCommand[2], "/") ?? false;
                    $directoryArr           = explode("/", self::$receivedCommand[2]);
                    if ($ControllerNamePosition) {
                        if (!is_dir(__DIR__ . "/../../app/Models/$directoryArr[0]")) {
                            mkdir(__DIR__ . "/../../app/Models/$directoryArr[0]");
                        }
                        $repNameSpc     = "\\" . $directoryArr[0];
                        $ModelStructure = str_replace("{{\directory}}", $repNameSpc, $ModelStructure);
                    } else {
                        $ModelStructure = str_replace("{{\directory}}", "", $ModelStructure);
                    }
                    file_put_contents($ModelCreateLink, $ModelStructure);
                    Log::success("Successfully model created . ");
                } else {
                    Log::error("This model is already has been exists . ");
                }

            } else {
                Log::error("You didn't name the model");
            }
        }
    }

    private static function ScanFolder(): array
    {
        $files = scandir(__DIR__);
        (array) $newFiles = [];
        foreach ($files as $key => $file) {
            if ($file === ' . ' || $file === ' ..' || $file === "Console . php") {
                continue;
            }
            $newFiles[] = $file;
        }
        return $newFiles;
    }

    public static function RunCommand(string $command, string $name = null): void
    {
        if (!$command == 'make:controller') {
            Log::error("Wrong controller create command . ");
            die;
        }
        if ($name === null) {
            Log::error("Controller name missing . ");
            die;
        }

        if ($command === 'make:controller') {

        }
    }


    public function run(): void
    {
        $this->migration();
        exit();
        self::serve();
        self::MakeController();
        self::MakeModel();
    }

}