<?php
namespace RestBundle\Parser;

use Nelmio\ApiDocBundle\Parser\JmsMetadataParser;
use Nelmio\ApiDocBundle\Parser\ParserInterface;

/**
 * Class OutputArray
 * @package RestBundle\Parser
 */
class OutputArray implements ParserInterface {

    /**
     * @var JmsMetadataParser
     */
    private $jmsMetadataParser;

    /**
     * @param JmsMetadataParser $jmsMetadataParser
     */
    public function __construct(JmsMetadataParser $jmsMetadataParser) {
        $this->jmsMetadataParser = $jmsMetadataParser;
    }

    /**
     * @param array $item
     * @return bool
     */
    public function supports(array $item) {
        list($className, $type) = $this->getClassType($item);
        if (empty($className) || empty($type)) {
            return false;
        }
        $item['class'] = $className;
        return $this->jmsMetadataParser->supports($item);
    }

    /**
     * @param array $item
     * @return array|bool
     */
    public function parse(array $item) {
        list($className, $type) = $this->getClassType($item);
        if (empty($className) || empty($type)) {
            return false;
        }
        $exp = explode("\\", $className);
        $item['class']  = $className;
        $returnData     = array('dataType' => $type,
            'required'      => true,
            'description'   => sprintf("%s of objects (%s)", $type, end($exp)),
            'readonly'      => false,
            'children'      => $this->jmsMetadataParser->parse($item)
        );
        return array('[]' => $returnData);
    }

    /**
     * @param array $item
     * @return array
     */
    private function getClassType(array $item) {
        $className = $type = '';
        if (preg_match('/(.+)\<(.+)\>/', $item['class'], $match)) {
            $className = $match[2];
            $type = $match[1];
        }
        return array($className, $type);
    }
}