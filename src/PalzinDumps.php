<?php

namespace PalzinDumps\PalzinDumps;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\{Collection, Str};
use PalzinDumps\PalzinDumps\Actions\SendPayload;
use PalzinDumps\PalzinDumps\Concerns\Colors;
use PalzinDumps\PalzinDumps\Observers\QueryObserver;
use PalzinDumps\PalzinDumps\Payloads\{ClearPayload,
    ColorPayload,
    DiffPayload,
    DumpPayload,
    LabelPayload,
    ModelPayload,
    Payload,
    PhpInfoPayload,
    RoutesPayload,
    ScreenPayload,
    TablePayload,
    TimeTrackPayload,
    ValidateStringPayload};

class PalzinDumps
{
    use Colors;

    public function __construct(
        public string  $notificationId = '',
        private string $fullUrl = '',
        private array $backtrace = [],
    ) {
        if (config('palzindumps.sleep')) {
            $sleep = intval(config('palzindumps.sleep'));
            sleep($sleep);
        }

        $this->fullUrl        = config('palzindumps.host') . ':' . config('palzindumps.port') . '/api/dumps';
        $this->notificationId = filled($notificationId) ? $this->notificationId : Str::uuid()->toString();
    }

    public function send(array|Payload $payload): array|Payload
    {
        if ($payload instanceof Payload) {
            $payload->trace($this->backtrace);
            $payload->notificationId($this->notificationId);
            $payload = $payload->toArray();

            SendPayload::handle($this->fullUrl, $payload);
        }

        return $payload;
    }

    /**
     * Send custom color
     *
     */
    public function color(string $color): PalzinDumps
    {
        $payload = new ColorPayload($color);
        $this->send($payload);

        return $this;
    }

    /**
     * Add new screen
     *
     */
    public function s(string $screen, bool $classAttr = false): PalzinDumps
    {
        return $this->toScreen($screen, $classAttr);
    }

    /**
     * Add new screen
     *
     * @param int $raiseIn Delay in seconds for the app to raise and focus
     */
    public function toScreen(
        string $screenName,
        bool $classAttr = false,
        int $raiseIn = 0
    ): PalzinDumps {
        $payload = new ScreenPayload($screenName, $classAttr, $raiseIn);
        $this->send($payload);

        return $this;
    }

    /**
     * Send custom label
     *
     */
    public function label(string $label): PalzinDumps
    {
        $payload = new LabelPayload($label);
        $this->send($payload);

        return $this;
    }

    /**
     * Send dump and die
     */
    public function die(string $status = ''): void
    {
        die($status);
    }

    /**
     * Clear screen
     *
     */
    public function clear(): PalzinDumps
    {
        $this->send(new ClearPayload());

        return $this;
    }

    /**
     * Send JSON data and validate
     *
     */
    public function isJson(): PalzinDumps
    {
        $payload = new ValidateStringPayload('json');

        $this->send($payload);

        return $this;
    }

    /**
     * Checks if content contains string.
     *
     * @param string $content
     * @param boolean $caseSensitive Search is case-sensitive
     * @param boolean $wholeWord Search for the whole words
     * @return PalzinDumps
     */
    public function contains(string $content, bool $caseSensitive = false, bool $wholeWord = false): PalzinDumps
    {
        $payload = new ValidateStringPayload('contains');
        $payload->setContent($content)
            ->setCaseSensitive($caseSensitive)
            ->setWholeWord($wholeWord);

        $this->send($payload);

        return $this;
    }

    /**
     * Send PHPInfo
     *
     */
    public function phpinfo(): PalzinDumps
    {
        $this->send(new PhpInfoPayload());

        return $this;
    }

    /**
     * Send Routes
     *
     */
    public function routes(mixed ...$except): PalzinDumps
    {
        $this->send(new RoutesPayload($except));

        return $this;
    }

    /**
     * Send Table
     *
     */
    public function table(Collection|array $data = [], string $name = ''): PalzinDumps
    {
        $this->send(new TablePayload($data, $name));

        return $this;
    }

    public function write(mixed $args = null, ?bool $autoInvokeApp = null): PalzinDumps
    {
        $originalContent = $args;
        $args            = Support\Dumper::dump($args);
        if (!empty($args)) {
            $payload = new DumpPayload($args, $originalContent);
            $payload->autoInvokeApp($autoInvokeApp);
            $this->send($payload);
        }

        return $this;
    }

    /**
     * Shows model attributes and relationship
     *
     */
    public function model(Model ...$models): PalzinDumps
    {
        foreach ($models as $model) {
            if ($model instanceof Model) {
                $payload    = new ModelPayload($model);
                $this->send($payload);
            }
        }

        return $this;
    }

    /**
     * Display all queries that are executed with custom label
     *
     */
    public function queriesOn(string $label = null): void
    {
        $backtrace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        app(QueryObserver::class)->setTrace($backtrace);
        app(QueryObserver::class)->enable($label);
    }

    /**
     * Stop displaying queries
     *
     */
    public function queriesOff(): void
    {
        app(QueryObserver::class)->disable();
    }

    /**
     * @param mixed $argument
     * @param boolean $splitDiff Outputs comparison result in 2 rows (original/diff).
     * @return PalzinDumps
     */
    public function diff(mixed $argument, bool $splitDiff = false): PalzinDumps
    {
        $argument  = is_array($argument) ? json_encode($argument) : $argument;

        $payload = new DiffPayload($argument, $splitDiff);
        $this->send($payload);

        return $this;
    }

    /**
     * Starts clocking a code block execution time
     *
     * @param string $reference Unique name for this time clocking
     */
    public function time(string $reference): void
    {
        $payload = new TimeTrackPayload($reference);
        $this->send($payload);
    }

    /**
     * Stops clocking a code block execution time
     *
     * @param string $reference Unique name called on ds()->time()
     */
    public function stopTime(string $reference): void
    {
        $payload = new TimeTrackPayload($reference);
        $this->send($payload);
    }
}
