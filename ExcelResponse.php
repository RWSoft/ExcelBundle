<?php

namespace RWSoft\ExcelBundle;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Rouven Weßling
 */
class ExcelResponse extends Response
{
	protected $send = false;
	protected $writer = null;

	/**
     * Constructor.
     *
     * @param   \PHPExcel_Writer_IWriter  $writer   A valid PHP callback
     * @param   integer                   $status   The response status code
     * @param   array                     $headers  An array of response headers
     *
     * @api
     */
	public function __construct(\PHPExcel_Writer_IWriter $writer = null, $status = 200, $headers = array())
	{
		parent::__construct(null, $status, $headers);

		$this->writer = $writer;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function create($callback = null, $status = 200, $headers = array())
	{
		return new static($callback, $status, $headers);
	}

	/**
	 * Set the PHPExcel Writer for this response
	 *
	 * @param \PHPExcel_Writer_IWriter $writer A PHPExcel Writer
	 *
	 * @throws \LogicException
	 */
	public function setWriter(\PHPExcel_Writer_IWriter $writer)
	{
		$this->writer = $writer;
	}

	/**
	 * {@inheritdoc}
	 *
	 * This method only sends the content once.
	 */
	public function sendContent()
	{
		if ($this->send) {
			return;
		}

		$this->send = true;

		if (null === $this->writer) {
			throw new \LogicException('A writer has to be set.');
		}

		$this->writer->save('php://output');
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws \LogicException when the content is not null
	 */
	public function setContent($content)
	{
		if (null !== $content) {
			throw new \LogicException('The content cannot be set on a ExcelResponse instance.');
		}
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return false
	 */
	public function getContent()
	{
		return false;
	}
}
