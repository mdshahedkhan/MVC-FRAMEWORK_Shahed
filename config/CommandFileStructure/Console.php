<?php
namespace App\Config\CommandFileStructure;

use App\Config\Log;

class Console
{
    private static string $ROOT_DIR_Command = __DIR__ . "/";
    private static array  $receivedCommand;
    private const CreateServerIP = "php -S 127.0.0.1:8080 -t public";
    private const CreateServer = "php -S localhost:8080 -t public";

    private const SERVE = 'serve', MakeController = 'make:controller', MakeModel = 'make:model', MakeMigration = 'make:migration';
    private static array $command = [self::SERVE => self::SERVE, self::MakeController => self::MakeController, self::MakeModel => self::MakeModel, self::MakeMigration => self::MakeMigration];

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

    public static function serve(): void
    {
        if (self::checkCommand() === true && self::$command[self::SERVE] === self::$receivedCommand[1]) {
            shell_exec(self::CreateServer);
        }
    }

    /**
     * @return void
     */
    public static function MakeController(): void
    {
        $ControllerName = isset(self::$receivedCommand[2]) ?? "";
        $makeController = isset(self::$receivedCommand[1]) ?? "";
        if (self::checkCommand() === true && in_array($makeController, self::$command)) {
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
        self::serve();
        self::MakeController();
        //self::ScanFolder();
    }

}