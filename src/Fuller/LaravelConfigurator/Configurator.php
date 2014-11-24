<?php namespace Fuller\LaravelConfigurator;

use Illuminate\Contracts\Config\Repository;

/**
 * Class Configurator
 *
 * @package Fuller\LaravelConfigurator
 */
class Configurator implements ConfiguratorInterface
{

    /**
     * Config repository instance
     *
     * @var Repository
     */
    protected $appConfigRepo;

    /**
     * Storage file path
     *
     * The storage file is a standard .php file that returns a key value array when included.
     * Example content: <?php return ['site.title'=>'Cool Site','mail.type'=>'smtp']'.
     *
     * @var string
     */
    protected $storageFile;

    /**
     * Currently loaded config options
     *
     * Example ['site.title'=>'Cool Site','mail.type'=>'smtp']
     *
     * @var array
     */
    protected $optionsArray;

    /**
     * @param Repository $appConfigRepo
     */
    public function __construct(Repository $appConfigRepo)
    {
        $this->appConfigRepo = $appConfigRepo;

        $this->storageFile = $this->appConfigRepo->get(
            'laravel-configurator::config.storage_file');
    }


    /**
     * Load config options from set storage file
     *
     * @return $this
     */
    public function load()
    {

        $this->optionsArray = [];

        if(file_exists($this->storageFile))
        {
            $this->optionsArray = include $this->storageFile;
        }

        return $this;
    }


    /**
     * Set option in loaded config array. Will not apply them to the set config repo.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        if(is_array($key))
        {
            foreach($key as $k=>$value)
            {
                $this->set($k, $value);
            }
            return;
        }

        $this->optionsArray[$key] = $value;

        return $this;
    }


    /**
     * Apply loaded options to app config
     *
     * @return $this
     */
    public function apply()
    {
        if(is_array($this->optionsArray))
        {
            foreach($this->optionsArray as $key=>$value)
            {
                $this->appConfigRepo->set($key, $value);
            }
        }

        return $this;
    }


    /**
     * Save loaded options to storage file
     *
     * @return void
     */
    public function save()
    {
        $content = '<?php return ' . var_export($this->optionsArray, true) . ';';
        $bytesSaved = file_put_contents($this->storageFile, $content);
    }




} 