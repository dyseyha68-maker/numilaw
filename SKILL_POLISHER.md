# Academic Polisher Skill Configuration

## Skill Metadata
```json
{
    "name": "academic-polisher",
    "version": "1.0.0",
    "description": "Comprehensive academic writing enhancement",
    "category": "writing",
    "tags": ["academic", "polishing", "enhancement"]
}
```

## Capabilities
- Academic grammar checks for common paper errors
- Terminology normalization
- Expression optimization (informal → formal)
- Logic structure improvements
- Academic writing principles adherence

## Parameters
| Parameter | Type | Required | Default | Description |
|-----------|------|----------|---------|-------------|
| level | string | No | moderate | Intervention level: light, moderate, comprehensive |
| preserve_formatting | boolean | No | true | Keep original document formatting |
| target_style | string | No | formal | Target writing style: formal, semi-formal |

## Usage Example
```
Use Academic Polisher to enhance my research paper abstract.
Level: comprehensive
Target style: formal
```

## Integration Points
- Can be run after Grammar Checker
- Input: plain text or markdown
- Output: enhanced academic text with change summary
